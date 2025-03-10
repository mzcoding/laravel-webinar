<?php

declare(strict_types=1);

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Queue\Queueable;

final class ExportProjectsJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private Collection $projects) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = [];
        foreach ($this->projects as $project) {
            $data[] = [$project->id, $project->name];
        }


        $fp = fopen(storage_path('/app/private/projects.csv'), 'w');

        foreach ($data as $fields) {
            fputcsv($fp, $fields, ',', '"', '');
        }

        fclose($fp);
    }
}
