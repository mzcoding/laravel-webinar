<?php

declare(strict_types=1);

namespace App\Services\Cache;

interface CacheInterface
{
    public function get(string $key, mixed $defaultValue = null): mixed;

    public function set(string $key, mixed $value, ?int $ttl = null): void;

    public function delete(string $key): bool;

    public function has(string $key): bool;
}
