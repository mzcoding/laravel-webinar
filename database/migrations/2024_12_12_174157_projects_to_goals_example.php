<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects_goals_example', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained();
            $table->foreignId('goal_id')->constrained();
            $table->integer('completed_percentage')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects_goals_example');
    }
};
