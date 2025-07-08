<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'user_id' => 1,
                'name' => 'Проект 1',
                'description' => 'Описание проекта 1',
            ],
            [
                'user_id' => 1,
                'name' => 'Проект 2',
                'description' => 'Описание проекта 2',
            ],
            [
                'user_id' => 1,
                'name' => 'Проект 3',
                'description' => 'Описание проекта 3',
            ],
        ];

        DB::table('projects')->insert($projects);

        Project::factory(10)->create();
    }
}
