<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Events\CreatedGoal;
use App\Http\Controllers\Controller;
use App\Http\Requests\Goals\CreateRequest;
use App\Http\Requests\Goals\UpdateRequest;
use App\Models\Goal;
use App\Repository\GoalRepository;
use App\Repository\GoalRepositoryInterface;
use App\Repository\ProjectRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class GoalController extends Controller
{
    public function __construct(
        private ProjectRepositoryInterface $projectRepository,
        private GoalRepositoryInterface $goalRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('goals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): RedirectResponse
    {
         $goal = $this->goalRepository->create($request->validated());
         event(new CreatedGoal($goal));

         return redirect()->route('projects.show', ['project' => $goal->project_id])
             ->with('success',  __('Цель успешно добавлена'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Goal $goal): View
    {
        return view('goals.show', [
            'goal' => $goal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goal $goal): View
    {
        return view('goals.edit', [
            'projects' => $this->projectRepository->list(),
            'goal' => $goal,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Goal $goal): RedirectResponse
    {
        $status = $this->goalRepository->update($goal, $request->validated());
        if ($status) {
            return redirect()->route('projects.show', ['project' => $goal->project_id])
                ->with('success', __('Цель успешно обновлена'));
        }

        return back()->with('error', __('Не удалось обновить цель'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal): JsonResponse
    {
        try {
            $this->goalRepository->delete($goal);

            return response()->json('ok');
        } catch (\Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
