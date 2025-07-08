<?php

declare(strict_types=1);

namespace App\Resolvers;

use App\Services\Contracts\CrudInterface;

interface CrudResolverInterface
{
    public function resolve(string $serviceClass): CrudInterface;
}
