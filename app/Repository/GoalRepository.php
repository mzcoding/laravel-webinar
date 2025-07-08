<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

final class GoalRepository extends BaseRepository implements GoalRepositoryInterface
{
    public function __construct(protected Model $model) {}
}
