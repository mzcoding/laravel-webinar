<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Project;

interface ProjectRepositoryInterface extends RepositoryInterface
{
    public function saveImage(Project $project, string $linkToImage): void;
}
