<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\RecordService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RecordService::class, function() {
            return new RecordService();
        });
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
