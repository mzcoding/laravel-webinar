<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\CrmIntegrationInterface;
use App\Services\Contracts\CrudInterface;
use Illuminate\Database\Eloquent\Model;

final class DomainService implements CrudInterface
{
    public function __construct(public CrmIntegrationInterface $crmIntegration)
    {
    }

    public function create(array $data): Model
    {
        // TODO: Implement create() method.
    }

    public function update(Model $model, array $data): Model
    {
        // TODO: Implement update() method.
    }

    public function delete(Model $delete): bool
    {
        // TODO: Implement delete() method.
    }

    public function resolve(string $serviceClass): CrudInterface
    {
        // TODO: Implement resolve() method.
    }
}
