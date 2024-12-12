<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

final  class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }

    public function list(): Collection
    {
        $newQuery = $this->model->newQuery();

        return $newQuery->with('user')->get();
    }
}
