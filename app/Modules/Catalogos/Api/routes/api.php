<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Catalogos\Api\Controllers\ClientesController;

Route::group(['prefix' => 'Catalogos'], function () {
    Route::get('clientes/', [ClientesController::class, 'index']);
});

