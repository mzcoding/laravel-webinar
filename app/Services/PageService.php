<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\Contracts\CrmIntegrationInterface;
use App\Services\Contracts\CrudInterface;
use Illuminate\Database\Eloquent\Model;

final class PageService implements CrudInterface
{
    public function __construct(public CrmIntegrationInterface $crmIntegration)
    {
    }

    public function create(array $data): Model
    {

    }

    public function update(Model $model, array $data): Model
    {
        return $model;
    }

    public function delete(Model $delete): bool
    {
        return true;
    }

    public function resolve(string $serviceClass): CrudInterface
    {
        // TODO: Implement resolve() method.
    }
}
