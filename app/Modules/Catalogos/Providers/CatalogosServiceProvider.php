<?php

namespace App\Modules\Catalogos\Providers;

use Illuminate\Support\ServiceProvider;

class CatalogosServiceProvider extends ServiceProvider
{

    public function register()
    {
        // $this->app->bind(Interface::class, Implementation::class);
    }


    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Api/routes/api.php');
    }

}
