<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Project;
use App\Services\Cache\CacheInterface;

final class CacheController extends Controller
{
    public function __construct(private CacheInterface $cache) {}

    public function __invoke()
    {
        $project = Project::query()->find(34);
        if ($this->cache->has('project')) {
            \Log::info('Кеш существует');

            return response()->json(['project' => $this->cache->get('project')]);
        }

        $this->cache->set('project', $project->name, 60);
        \Log::info('Добавили в кеш');

        return response()->json(['project' => $this->cache->get('project')]);
    }
}
