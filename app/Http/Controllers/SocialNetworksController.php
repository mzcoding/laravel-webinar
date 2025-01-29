<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\SocialUserInterface;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Psr\Log\LoggerInterface;

final class SocialNetworksController extends Controller
{
    public function __construct(private readonly LoggerInterface $logger) {}

    public function redirect(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(SocialUserInterface $socialService, string $provider): RedirectResponse
    {
        try {
            $socialService->createOrUpdateUserViaSocialNetwork(Socialite::driver($provider)->user(), $provider);
        } catch (\Exception $exception) {
            $this->logger->error($exception->getMessage());
        }

        return redirect()->route('account');
    }
}
