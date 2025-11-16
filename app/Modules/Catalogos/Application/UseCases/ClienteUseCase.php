<?php

namespace App\Modules\Catalogos\Application\UseCases;

use App\Modules\Catalogos\Domain\Repositories\ClienteRInterface;
use Illuminate\Database\Eloquent\Collection;

class ClienteUseCase
{
    private ClienteRInterface $clienteRepository;

    /**
     * Aquí no se podria inyectar directamente el repositorio concreto (ClientesRRepository::class)
     * porque pertenece a una capa superior (Infraestructura) y rompería el principio de inversión de dependencias.
     * En su lugar, inyectamos la interfaz del repositorio (ClienteRInterface::class) de una capa inferior (Dominio).
     * De este modo, el caso de uso depende de una abstracción y no de una implementación concreta.
     * Y resolvemos la implementación concreta del repositorio en el Service Provider del módulo Catalogos.
     */
    public function __construct(ClienteRInterface $clienteRepository) {
        $this->clienteRepository = $clienteRepository;
    }

    public function execute(): Collection
    {
        return $this->clienteRepository->all();
    }
}