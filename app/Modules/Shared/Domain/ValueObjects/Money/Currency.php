<?php

namespace App\Modules\Shared\Domain\ValueObjects\Money;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Class Currency
 *
 * Representa una moneda ISO 4217 de forma inmutable.
 */
final class Currency
{
    use IsValueObject;

    private string $code;

    /**
     * Lista de códigos de moneda válidos.
     * @var string[]
     */
    private const VALID_CURRENCIES = [
        'USD', 'EUR', 'MXN', 'GBP', 'JPY', 'CAD', 'AUD', 'CHF', 'CNY', 'INR'
    ];

    /**
     * @param string $code Código ISO 4217
     */
    public function __construct(string $code)
    {
        $code = strtoupper($code);

        if (!in_array($code, self::VALID_CURRENCIES, true)) {
            throw new \InvalidArgumentException("Invalid currency code: {$code}");
        }

        $this->code = $code;
    }

    /**
     * Devuelve el código de moneda.
     */
    public function value(): string
    {
        return $this->code;
    }

    /**
     * Compara igualdad con otra moneda
     */
    public function equals(Currency $other): bool
    {
        return $this->code === $other->code;
    }
}
