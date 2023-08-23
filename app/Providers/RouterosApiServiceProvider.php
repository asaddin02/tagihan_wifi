<?php

namespace App\Providers;

use App\Helpers\RouterosAPI;
use Illuminate\Support\ServiceProvider;

class RouterosApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->singleton('routerosAPI', function () {
            return new RouterosAPI('192.168.1.2', 'innofasa', 'rahima2018');
        });
    }
}
