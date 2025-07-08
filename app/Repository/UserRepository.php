<?php

declare(strict_types=1);

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

final class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(protected Model $model) {}
}
