<?php

namespace Domain\ValueObject;

class ClienteNombre
{
    private string $value;

    public function __construct(string $value)
    {
        // if (empty($value)) {
        //     throw new \InvalidArgumentException("User name o apellido cannot be empty.");
        // }

        if (!is_string($value)) {
            throw new \InvalidArgumentException("El nombre debe ser un string.");
        }

        if (strlen(trim($value)) < 2) {
            throw new \InvalidArgumentException("El nombre debe tener al menos 2 caracteres.");
        }

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}