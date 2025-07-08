<?php

declare(strict_types=1);

namespace App\Services\Cache;

use Illuminate\Contracts\Cache\Factory as CacheFactory;
use Psr\SimpleCache\InvalidArgumentException;

final readonly class CacheService implements CacheInterface
{
    public function __construct(
        private CacheFactory $cache,
        private string $driver
    ) {}

    /**
     * @throws InvalidArgumentException
     */
    public function get(string $key, mixed $defaultValue = null): mixed
    {
        return $this->cache->store($this->driver)->get($key, $defaultValue);
    }

    public function set(string $key, mixed $value, ?int $ttl = 100): void
    {
        $this->cache->store($this->driver)->put($key, $value, $ttl);
    }

    public function delete(string $key): bool
    {
        return $this->cache->store($this->driver)->forget($key);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function has(string $key): bool
    {
        return $this->cache->store($this->driver)->has($key);
    }
}
