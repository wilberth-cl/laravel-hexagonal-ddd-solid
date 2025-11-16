<?php

namespace App\Modules\Catalogos\Providers;

use App\Modules\Catalogos\Infrastructure\Persistence\Repositories\ClientesRRepository;
use App\Modules\Catalogos\Domain\Repositories\ClienteRInterface;
use Illuminate\Support\ServiceProvider;

class CatalogosServiceProvider extends ServiceProvider
{

    public function register()
    {
        // $this->app->bind(Interface::class, Implementation::class);
        $this->app->bind(ClienteRInterface::class, ClientesRRepository::class);
    }


    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Api/routes/api.php');
    }

}
