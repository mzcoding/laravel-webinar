<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\SocialUserEvent;
use App\Models\Network;

final class SyncNetworksTableListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    public function __invoke(SocialUserEvent $event): void
    {
        $this->handle($event);
    }

    /**
     * Handle the event.
     */
    public function handle(SocialUserEvent $event): void
    {
        Network::query()->updateOrCreate([
            'user_id' => $event->user->id,
            'network_type' => $event->socialUserDto->networkType,
            'network_id' => $event->socialUserDto->networkId,
        ], [
            'token' => $event->socialUserDto->token,
            'refresh_token' => $event->socialUserDto->refreshToken,
            'avatar' => $event->socialUserDto->avatar,
        ]);
    }
}
