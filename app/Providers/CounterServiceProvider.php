<?php

namespace App\Providers;

use App\Counters\VisitCounter;
use Illuminate\Support\ServiceProvider;

class CounterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('visit_counter', function(){
            return new VisitCounter();
        });
    }
}
