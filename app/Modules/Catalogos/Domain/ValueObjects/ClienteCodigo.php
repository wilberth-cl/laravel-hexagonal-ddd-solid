<?php

namespace Domain\ValueObject;

class ClienteCodigo
{
    private string $value;

    public function __construct(string $value)
    {
        if (empty($value)) {
            throw new \InvalidArgumentException("Codigo de Cliente cannot be empty.");
        }

        $this->value = $value;
    }

    #Comportamiento

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}