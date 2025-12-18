<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Event;
use App\Policies\EventPolicy;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Event::class, EventPolicy::class);

        Gate::define('manage-users', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('manage-all-events', function ($user) {
            return $user->isAdmin();
        });

        Gate::define('create-event', function ($user) {
            return $user->canCreateEvent();
        });

        app()->setLocale('id');
        \Carbon\Carbon::setLocale('id');
    }
}