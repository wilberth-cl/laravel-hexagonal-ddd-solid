<?php

namespace App\Modules\Shared\Domain\ValueObjects\Inventory;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Class Quantity
 *
 * Representa cantidad de inventario y permite operaciones aritméticas.
 */
final class Quantity
{
    use IsValueObject;

    private string $value;

    public function __construct(int|string $value)
    {
        if (bccomp((string)$value, '0', 0) === -1) {
            throw new \InvalidArgumentException("Quantity cannot be negative");
        }
        $this->value = (string)$value;
    }

    public function value(): string { return $this->value; }

    /** Suma otra cantidad */
    public function add(Quantity $other): self
    {
        return new self(bcadd($this->value, $other->value(), 0));
    }

    /** Resta otra cantidad */
    public function subtract(Quantity $other): self
    {
        $newValue = bcsub($this->value, $other->value(), 0);
        if (bccomp($newValue, '0', 0) === -1) {
            throw new \InvalidArgumentException("Resulting quantity cannot be negative");
        }
        return new self($newValue);
    }

    /** Multiplica por un factor */
    public function multiply(int|string $factor): self
    {
        if (bccomp((string)$factor, '0', 0) === -1) {
            throw new \InvalidArgumentException("Factor cannot be negative");
        }
        return new self(bcmul($this->value, (string)$factor, 0));
    }

    /** Divide por un divisor */
    public function divide(int|string $divisor): self
    {
        if (bccomp((string)$divisor, '0', 0) <= 0) {
            throw new \InvalidArgumentException("Divisor must be greater than zero");
        }
        return new self((int)bcdiv($this->value, (string)$divisor, 0));
    }
}

