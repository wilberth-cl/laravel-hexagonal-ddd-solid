<?php

namespace App\Modules\Catalogos\Application\DTOs;

class ClienteDTO
{
    public function __construct(
        /* Cambiar por datos reales, esto solo un ejemplo */
        public readonly string $clienteId,
        public readonly float $total,
        public readonly array $renglones // array de ['producto_id', 'cantidad', 'precio_unitario']

    ) {}


    public static function fromArray(array $data): self
    {
        return new self(
            clienteId: $data["clienteId"],
            total: $data["total"],
            renglones: $data["renglones"]
        );
    }

}

