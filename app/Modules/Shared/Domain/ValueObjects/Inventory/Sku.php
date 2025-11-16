<?php

namespace App\Modules\Shared\Domain\ValueObjects\Inventory;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Class Sku
 *
 * Value Object que representa un SKU de inventario.
 */
final class Sku
{
    use IsValueObject;

    private string $value;

    /**
     * Sku constructor.
     *
     * @param string $value Formato alfanumérico
     */
    public function __construct(string $value)
    {
        $this->value = strtoupper(trim($value));
    }

    public function value(): string { return $this->value; }
}

