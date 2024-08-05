<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\EventService;
use App\Services\FollowupService;
use App\Services\QueuedNotificationService;
use App\Services\TicketService;
use App\Services\UserService;
use App\Services\TicketUserService;
use App\ServicesImpl\EventServiceImpl;
use App\ServicesImpl\FollowupServiceImpl;
use App\ServicesImpl\QueuedNotificationServiceImpl;
use App\ServicesImpl\TicketServiceImpl;
use App\ServicesImpl\UserServiceImpl;
use App\ServicesImpl\TicketUserServiceImpl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventService::class, EventServiceImpl::class);
        $this->app->bind(FollowupService::class, FollowupServiceImpl::class);
        $this->app->bind(QueuedNotificationService::class, QueuedNotificationServiceImpl::class);
        $this->app->bind(TicketService::class, TicketServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(TicketUserService::class, TicketUserServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
