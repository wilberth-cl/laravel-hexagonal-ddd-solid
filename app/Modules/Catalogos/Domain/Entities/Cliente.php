<?php

namespace App\Modules\Catalogos\Domain\Entities;

use App\Modules\Shared\Domain\ValueObjects\Contact\Email;
use Domain\ValueObject\Edad;
use Domain\ValueObject\ClienteCodigo;
use Domain\ValueObject\ClienteNombre;
use Domain\ValueObject\Curp;

class Cliente
{
    # db: clientes
    # Modelado del dominio/entidad Cliente

    private ClienteCodigo $id;
    private ClienteNombre $nombre;
    private ClienteNombre $apellido;
    private Edad $edad;
    private Email $email;
    private Curp $curp;

    public function __construct(
        ClienteCodigo $id,
        ClienteNombre $nombre,
        ClienteNombre $apellido,
        Edad $edad,
        Email $email,
        Curp $curp
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->edad = $edad;
        $this->email = $email;
        $this->curp = $curp;
    }

    # Comportamiento

    public static function fromArray(array $data): self
    {
        return new self(
            new ClienteCodigo($data['id']),         // Validación en el VO
            new ClienteNombre($data['nombre']),     // Validación en el VO
            new ClienteNombre($data['apellido']),   // Validación en el VO
            new Edad($data['edad']),                // Validación en el VO
            new Email($data['email']),              // Validación en el VO
            new Curp($data['curp'])                 // Validación en el VO
        );
    }

    # Servicios de dominio/entidad

    public function fullName(): string
    {
        return $this->nombre->getValue() . ' ' . $this->apellido->getValue();
    }

}
