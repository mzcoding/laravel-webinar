<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Resolvers\CrudResolverInterface;
use Illuminate\Database\Eloquent\Model;

interface CrudInterface extends CrudResolverInterface
{
   public function create(array $data): Model;
   public function update(Model $model, array $data): Model;
   public function delete(Model $delete): bool;
}
