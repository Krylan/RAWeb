<?php

declare(strict_types=1);

namespace App\Site\Listeners;

use App\Site\Models\User;
use App\Site\Notifications\UserRegistrationNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Notification;

class SendUserRegistrationNotification
{
    public function handle(Registered $event): void
    {
        /** @var User $user */
        $user = $event->user;
        Notification::route('webhook', config('services.discord.webhook.users'))
            ->notify(new UserRegistrationNotification($user));
    }
}
