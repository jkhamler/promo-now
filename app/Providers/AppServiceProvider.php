<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
<<<<<<< HEAD
public function boot()
{
    Schema::defaultStringLength(191);
}
=======
    public function boot()
    {
    }
>>>>>>> a7df634f59bf91a8f6b16434906a2afee94fd512

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
