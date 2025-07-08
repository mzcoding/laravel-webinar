<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User as UserModel;
use Laravel\Socialite\Contracts\User;

interface SocialUserInterface
{
    public function createOrUpdateUserViaSocialNetwork(User $socialUser, string $provider): UserModel;
}
