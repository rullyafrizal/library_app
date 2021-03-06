<?php

namespace App\Providers;

use App\Events\GetRequest;
use App\Listeners\CacheRequest;
use App\Models\Author;
use App\Models\Book;
use App\Observers\AuthorObserver;
use App\Observers\BookObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Author::observe(AuthorObserver::class);
        Book::observe(BookObserver::class);
    }
}
