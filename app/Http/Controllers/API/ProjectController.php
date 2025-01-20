<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Projects\CreateRequest;
use App\Http\Requests\Projects\UpdateRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Repository\ProjectRepositoryInterface;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private ProjectRepositoryInterface $projectRepository
    ) {}


    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return $this->projectRepository->list(true);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateRequest $request): JsonResponse
    {
        $this->projectRepository->create($request->validated());

        return response()->json(['message' => 'Project created successfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project): ProjectResource
    {
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Project $project): JsonResponse
    {
        $this->projectRepository->update($project, $request->validated());

        return response()->json(['message' => 'Project updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project): JsonResponse
    {
        try {
            $project->delete();

            return response()->json(['message' => 'Project deleted successfully']);
        } catch (\Throwable $exception) {
            return response()->json(['message' => 'Project can not delete'], 400);
        }
    }
}
