<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class ModuleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $modulePath = app_path('Modules');

        if (!File::exists($modulePath)) {
            return 0;
        }

        $modules = File::directories($modulePath);

        foreach ($modules as $module) {
            $moduleName = basename($module);
            $providerClass = "App\\Modules\\{$moduleName}\\Providers\\{$moduleName}ServiceProvider";

            if (class_exists($providerClass)) {
                $this->app->register($providerClass);
            }
        }
    }

}