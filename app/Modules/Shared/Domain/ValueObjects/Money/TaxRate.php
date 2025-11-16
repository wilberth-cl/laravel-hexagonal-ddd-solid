<?php

namespace App\Modules\Shared\Domain\ValueObjects\Money;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Class TaxRate
 *
 * Representa una tasa de impuesto entre 0 y 1.
 */
final class TaxRate
{
    use IsValueObject;

    private string $rate;
    private int $scale;

    public function __construct(float|string $rate, int $scale = 4)
    {
        if (bccomp((string)$rate, '0', $scale) === -1 || bccomp((string)$rate, '1', $scale) === 1) {
            throw new \InvalidArgumentException("Tax rate must be between 0 and 1");
        }
        $this->rate = (string)$rate;
        $this->scale = $scale;
    }

    public function value(): string { return $this->rate; }

    /** Aplica la tasa a un Money */
    public function applyTo(Money $money): Money
    {
        return $money->multiply(bcadd('1', $this->rate, $money->scale()));
    }
}

