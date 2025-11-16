<?php

namespace App\Modules\Shared\Domain\ValueObjects\Inventory;

use App\Modules\Shared\Support\Traits\IsValueObject;
use InvalidArgumentException;

/**
 * Class UnitOfMeasure
 *
 * Value Object que representa la unidad de medida de inventario.
 */
final class UnitOfMeasure
{
    use IsValueObject;

    private string $unit;

    /**
     * UnitOfMeasure constructor.
     *
     * @param string $unit Unidad (ej: kg, pcs, l)
     * @throws InvalidArgumentException si la unidad está vacía
     */
    public function __construct(string $unit)
    {
        if (empty($unit)) {
            throw new InvalidArgumentException("Unit of measure cannot be empty");
        }
        $this->unit = strtolower($unit);
    }

    public function value(): string { return $this->unit; }
}

