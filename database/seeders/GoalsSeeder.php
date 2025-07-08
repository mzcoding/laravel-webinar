<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Seeder;

class GoalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Goal::factory(10)->create();
    }
}
