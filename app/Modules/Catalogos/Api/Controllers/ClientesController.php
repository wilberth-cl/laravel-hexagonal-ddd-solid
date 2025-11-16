<?php

namespace App\Modules\Catalogos\Api\Controllers;

use App\Modules\Catalogos\Application\UseCases\ClienteUseCase;

class ClientesController
{
    private ClienteUseCase $clienteusecase;

    public function __construct(ClienteUseCase $clienteusecase)
    {
        $this->clienteusecase = $clienteusecase;
    }

    public function index()
    {
        $rs = $this->clienteusecase->execute();
        return response()->apiSuccess(['message' => $rs]);
    }
}