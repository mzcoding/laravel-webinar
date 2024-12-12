<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Goals\CreateRequest;
use App\Models\Goal;
use App\Repository\GoalRepository;
use App\Repository\GoalRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class GoalController extends Controller
{
    public function __construct(private GoalRepositoryInterface $goalRepository)
    {

    }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
