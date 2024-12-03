<?php

declare(strict_types=1);

namespace App\Services\Contracts;

use App\Models\User;

interface CrmIntegrationInterface
{
   public function sendData(User $user): bool;

}
