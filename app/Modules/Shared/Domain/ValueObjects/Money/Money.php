<?php

namespace App\Modules\Shared\Domain\ValueObjects\Money;

use App\Modules\Shared\Support\Traits\IsValueObject;
use App\Modules\Shared\Domain\ValueObjects\Money\Currency;
use App\Modules\Shared\Domain\ValueObjects\Money\TaxRate;

/**
 * Class Money
 *
 * Representa un monto monetario y permite operaciones aritméticas con precisión arbitraria.
 */
final class Money
{
    use IsValueObject;

    private string $amount; // almacenamos como string para precisión BCMath
    private Currency $currency;
    private int $scale;

    /**
     * @param float|string $amount Monto
     * @param Currency $currency Moneda
     * @param int $scale Precisión decimal para operaciones
     */
    public function __construct(float|string $amount, Currency $currency, int $scale = 2)
    {
        if (bccomp((string)$amount, '0', $scale) === -1) {
            throw new \InvalidArgumentException("Amount cannot be negative");
        }

        $this->amount = (string)$amount;
        $this->currency = $currency;
        $this->scale = $scale;
    }

    public function amount(): string { return $this->amount; }
    public function currency(): Currency { return $this->currency; }
    public function scale(): int { return $this->scale; }

    /** Suma otro Money del mismo tipo */
    public function add(Money $other): self
    {
        $this->assertSameCurrency($other);
        $newAmount = bcadd($this->amount, $other->amount(), $this->scale);
        return new self($newAmount, $this->currency, $this->scale);
    }

    /** Resta otro Money del mismo tipo */
    public function subtract(Money $other): self
    {
        $this->assertSameCurrency($other);
        $newAmount = bcsub($this->amount, $other->amount(), $this->scale);
        if (bccomp($newAmount, '0', $this->scale) === -1) {
            throw new \InvalidArgumentException("Resulting amount cannot be negative");
        }
        return new self($newAmount, $this->currency, $this->scale);
    }

    /** Multiplica por un factor */
    public function multiply(string|float $factor): self
    {
        if (bccomp((string)$factor, '0', $this->scale) === -1) {
            throw new \InvalidArgumentException("Factor cannot be negative");
        }
        $newAmount = bcmul($this->amount, (string)$factor, $this->scale);
        return new self($newAmount, $this->currency, $this->scale);
    }

    /** Divide por un divisor */
    public function divide(string|float $divisor): self
    {
        if (bccomp((string)$divisor, '0', $this->scale) <= 0) {
            throw new \InvalidArgumentException("Divisor must be greater than zero");
        }
        $newAmount = bcdiv($this->amount, (string)$divisor, $this->scale);
        return new self($newAmount, $this->currency, $this->scale);
    }

    /** Aplica una tasa de impuesto */
    public function applyTax(TaxRate $taxRate): self
    {
        $factor = bcadd('1', (string)$taxRate->value(), $this->scale);
        return $this->multiply($factor);
    }

    /** Compara igualdad con otro Money */
    public function equals(Money $other): bool
    {
        return $this->currency()->value() === $other->currency()->value()
            && bccomp($this->amount, $other->amount(), $this->scale) === 0;
    }

    private function assertSameCurrency(Money $other): void
    {
        if ($this->currency()->value() !== $other->currency()->value()) {
            throw new \InvalidArgumentException("Currencies must match for operation");
        }
    }
}

