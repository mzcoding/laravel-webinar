<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SocialUserInterface;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;

final class SocialNetworksController extends Controller
{
    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(SocialUserInterface $socialService, string $provider): RedirectResponse
    {
        try {
            $socialService->createOrUpdateUserViaSocialNetwork(Socialite::driver($provider)->user(), $provider);
        } catch (\Exception $exception) {
            \Log::error($exception->getMessage());
        }

        return redirect()->route('account');
    }
}
