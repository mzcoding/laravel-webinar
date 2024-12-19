<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

final class StepRepository extends BaseRepository implements StepRepositoryInterface
{
    public function __construct(protected Model $model)
    {
    }
}
