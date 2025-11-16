<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory; // Importar ResponseFactory

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Macro para respuestas exitosas
        ResponseFactory::macro('apiSuccess', function ($data = null, String $message = 'Operacion correcta', String $code = '', int $status = 200)
        {
            return response()->json([
                'state' => true,
                'code' => $code,
                'message' => $message,
                'data' => $data,
                'status' => $status,
            ], $status);
        });

        // Macro para respuestas de error
        ResponseFactory::macro('apiError', function (String $message = 'Operacion con error', String $code = '', int $status = 400, array $errors = [], String $errorcode = '')
        {
            return response()->json([
                'state' => false,
                'code' => $code,
                'message' => $message,
                'errors' => $errors,
                'status' => $status,
                'errorcode' => $errorcode,
            ], $status);
        });

        // Macro para respuestas de validación
        ResponseFactory::macro('apiValidationError', function (string $message = 'Operacion con error, datos no validos.', String $code = '', int $status = 422, array $errors = [], String $errorcode = '')
        {
            return response()->json([
                'state' => false,
                'code' => $code,
                'message' => $message,
                'errors' => $errors,
                'status' => $status,
                'errorcode' => $errorcode,
            ], $status);
        });

        // Macro para "No Contenido" (204)
        ResponseFactory::macro('apiNoContent', function ($data = null, string $message = 'Operacion correcta, sin datos', String $code = '')
        {
            return response()->json([
                'state' => true,
                'code' => $code,
                'message' => $message,
                'data' => $data,
                'status' => '204',
            ], 204);
        });
    }
}