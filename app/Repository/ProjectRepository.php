<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function __construct(protected Model $model) {}

    public function saveImage(Project $project, string $linkToImage): void
    {
        $project->image = $linkToImage;
        $project->save();
    }

    public function list(bool $isApi = false): Collection
    {
        $newQuery = $this->model->newQuery();

        if ($isApi) {
            return $newQuery->select(['id', 'name', 'description', 'image', 'created_at'])->get();
        }

        return $newQuery
            ->with('user')
            ->get();
    }
}
