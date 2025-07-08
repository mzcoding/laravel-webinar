<?php

declare(strict_types=1);

namespace App\Services;

use App\Events\SocialUserEvent;
use App\Models\Network;
use App\Models\User as UserModel;
use Illuminate\Contracts\Auth\Factory as AuthInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Contracts\User;

final class SocialUser implements SocialUserInterface
{
    public function __construct(private readonly AuthInterface $auth) {}

    public function createOrUpdateUserViaSocialNetwork(User $socialUser, string $provider): UserModel
    {
        $password = null;
        $email = $socialUser->getEmail();
        if ($email === null) {
            $network = Network::query()
                ->where('network_type', $provider)
                ->where('network_id', $socialUser->getId())
                ->first();

            if ($network) {
                $email = $network->user->email;
            } else {
                $email = 'stas.ivanov22@mail.ru';

                // Редирект на форму с email
            }
        }

        $user = UserModel::query()->where('email', $email)->first();

        if ($user === null) {
            $password = Str::random(8);

            $user = UserModel::query()->create([
                'email' => $email,
                'password' => Hash::make($password),
                'name' => $socialUser->getName(),
            ]);
        }

        $dto = new SocialUserDto(
            $email,
            $socialUser->getName(),
            $provider,
            $socialUser->getId(),
            $socialUser->token,
            $socialUser->refreshToken,
            $socialUser->getAvatar(),
            $password
        );

        event(new SocialUserEvent($user, $dto));
        $this->auth->guard()->login($user);

        return $user;
    }
}
