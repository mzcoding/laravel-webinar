<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Services\Contracts\CrmIntegrationInterface;
use App\Services\Contracts\CrudInterface;
use Illuminate\Database\Eloquent\Model;

final class CrudResolver implements CrudInterface
{
    private CrudInterface $crud;

    public function __construct(private CrmIntegrationInterface $crmIntegration) {}

    public function create(array $data): Model
    {
        return $this->crud->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        return $this->crud->update($model, $data);
    }

    public function delete(Model $delete): bool
    {
        return $this->crud->delete($delete);
    }

    public function resolve(string $serviceClass): CrudInterface
    {
        $className = '\\App\\Services\\'.$serviceClass;
        $this->crud = new $className($this->crmIntegration);

        return $this;
    }
}
