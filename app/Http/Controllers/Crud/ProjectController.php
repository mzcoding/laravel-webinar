<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateRequest;
use App\Http\Requests\Projects\UpdateRequest;
use App\Mail\ProjectMail;
use App\Models\Project;
use App\Notifications\StatNotification;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use App\Services\FileUpload;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

final class ProjectController extends Controller
{
    public function __construct(
        private FileUpload $fileUpload,
        private UserRepositoryInterface $userRepository,
        private ProjectRepositoryInterface $projectRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('projects.index', [
            'projects' => $this->projectRepository->list(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {;
        return view('projects.create', [
            'users' => $this->userRepository->list(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $project = $this->projectRepository->create($request->validated());
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $this->projectRepository->saveImage($project, $this->fileUpload->upload($file, $project));
            }
        }

        Mail::to($project->user)->send(new ProjectMail($project));

        return redirect()->route('projects.index')->with('success', __('Проект успешно создан'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        return view('projects.show', [
            'project' => $project,
            'report'  => [
                'href' => route('projects.edit', $project),
                'text' => __('Редактировать')
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project): View
    {
        return view('projects.edit', [
            'project' => $project,
            'users' => $this->userRepository->list(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws \Exception
     */
    public function update(UpdateRequest $request, Project $project): RedirectResponse
    {
        $data = $request->validated();
        unset($data['image']);

        $status = $this->projectRepository->update($project, $data);

        if ($status) {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $link = $this->fileUpload->upload(
                        $file,
                        $project
                    );

                    $this->projectRepository->saveImage(
                        $project,
                        $link
                    );
                }
            }

            $delay = now()->addMinutes(5);
            $user = $project->user ?? Auth::user();
            $user->notify((new StatNotification($project))->delay($delay));
            return redirect()->route('projects.index')->with('success', __('Проект успешно обновлен'));
        }

        return back()->with('error', __('Не удалось обновить проект'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        try {
            $this->projectRepository->delete($project);

            return response()->json('ok');
        } catch (\Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
