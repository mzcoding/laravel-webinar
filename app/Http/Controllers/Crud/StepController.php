<?php

declare(strict_types=1);

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Steps\CreateRequest;
use App\Http\Requests\Steps\UpdateRequest;
use App\Models\Step;
use App\Repository\StepRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class StepController extends Controller
{
    public function __construct(private StepRepositoryInterface $repository) {}
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
        return view('steps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        return redirect()->route('goals.show', ['goal' => $request->goal_id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Step $step): View
    {
        return view('steps.edit', [
            'step' => $step,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Step $step): RedirectResponse
    {
       $status =  $this->repository->update($step, $request->validated());
       if ($status) {
           return redirect()->route('goals.show', ['goal' => $step->goal_id]);
       }

       return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Step $step): JsonResponse
    {
        try {
            $this->repository->delete($step);

            return response()->json('ok');
        } catch (\Throwable $exception) {
            return response()->json(['error' => $exception->getMessage()], 500);
        }
    }
}
