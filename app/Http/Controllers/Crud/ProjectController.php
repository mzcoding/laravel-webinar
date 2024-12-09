<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateRequest;
use App\Http\Requests\Projects\UpdateRequest;
use App\Models\Project;
use App\Models\User;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class ProjectController extends Controller
{
    public function __construct(
        private USerRepositoryInterface $userRepository,
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
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $this->projectRepository->create($request->validated());

        return redirect()->route('projects.index')->with('success', __('Проект успешно создан'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): View
    {
        //
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
     */
    public function update(UpdateRequest $request, Project $project): RedirectResponse
    {
        $project = $this->projectRepository->update($project, $request->validated());
        if ($project) {
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
