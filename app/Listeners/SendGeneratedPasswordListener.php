<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\SocialUserEvent;
use App\Mail\SocialRegisteredMail;
use Illuminate\Support\Facades\Mail;

class SendGeneratedPasswordListener
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
        if ($event->socialUserDto->password !== null) {
            Mail::to($event->user)->send(new SocialRegisteredMail($event->socialUserDto));
        }
    }
}
