<?php

namespace Domain\ValueObject;

class Edad
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 0) {
            throw new \InvalidArgumentException("Edad de Cliente cannot be negative.");
        }

        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}