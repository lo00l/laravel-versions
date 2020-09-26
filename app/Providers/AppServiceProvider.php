<?php

namespace App\Providers;

use App\Contracts\ReleaseFetcherInterface;
use App\Support\GithubReleaseFetcher;
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
        $this->app->bind(ReleaseFetcherInterface::class, GithubReleaseFetcher::class);
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
