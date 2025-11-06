<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Registered event is handled manually in boot() to catch mail errors
        // Registered::class => [
        //     SendEmailVerificationNotification::class,
        // ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Wrap the Registered event listener to catch mail errors
        Event::listen(Registered::class, function ($event) {
            try {
                $listener = new SendEmailVerificationNotification();
                $listener->handle($event);
            } catch (\Exception $e) {
                // Log mail errors but don't break the registration flow
                if (str_contains($e->getMessage(), 'Connection could not be established') ||
                    str_contains($e->getMessage(), 'Unable to connect') ||
                    str_contains($e->getMessage(), 'stream_socket_client') ||
                    str_contains($e->getMessage(), 'mail.locumkit.com')) {
                    \Illuminate\Support\Facades\Log::warning('Mail connection error in verification email: ' . $e->getMessage());
                    // Don't rethrow - let registration continue
                    return;
                }
                // Re-throw other exceptions
                throw $e;
            }
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
