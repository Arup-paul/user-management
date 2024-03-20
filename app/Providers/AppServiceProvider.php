<?php

namespace App\Providers;

use App\Events\UserAddressSaved;
use App\Listeners\SaveUserAddressesListener;
use App\Services\UserImageUploadService;
use App\Services\UserImageUploadServiceInterface;
use App\Services\UserService;
use App\Services\UserServiceInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(UserImageUploadServiceInterface::class, UserImageUploadService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
