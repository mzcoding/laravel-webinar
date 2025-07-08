<?php

declare(strict_types=1);

namespace App\Services;

final class SocialUserDto
{
    public function __construct(
        public string $email,
        public string $name,
        public string $networkType,
        public int|string $networkId,
        public string $token,
        public string $refreshToken,
        public ?string $avatar,
        public ?string $password,
    ) {}
}
