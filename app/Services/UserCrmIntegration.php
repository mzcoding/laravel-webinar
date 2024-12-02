<?php

declare(strict_types=1);

namespace App\Services;


use App\Models\User;
use App\Services\Contracts\CrmIntegrationInterface;
use Illuminate\Support\Facades\Log;

final class UserCrmIntegration implements CrmIntegrationInterface
{
    public function __construct(public bool $debug)
    {}

    public function sendData(User $user): bool
    {
        Log::info("Send NEW USER: " . $user->id);

        if ($this->debug === true) {
            return true;
        }

        return false;
    }
}
