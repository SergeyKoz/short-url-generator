<?php

namespace App\Providers;

use App\Interfaces\UrlRepositoryInterface;
use App\Interfaces\UrlServiceInterface;
use App\Repositories\UrlRepository;
use App\Services\UrlService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UrlServiceInterface::class,UrlService::class);
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
