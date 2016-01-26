<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class MenuServiceProviders extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('menu', function($app) {
            return new Menu();
        });
    }
}