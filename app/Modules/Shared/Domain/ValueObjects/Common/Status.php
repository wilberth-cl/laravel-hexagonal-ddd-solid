<?php

namespace App\Modules\Shared\Domain\ValueObjects\Common;

use App\Modules\Shared\Support\Traits\IsValueObject;
use InvalidArgumentException;

/**
 * Class Status
 *
 * Value Object que representa un estado genérico.
 */
final class Status
{
    use IsValueObject;

    private string $value;

    /**
     * Status constructor.
     *
     * @param string $value Estado permitido (N: Vigente, C: Cancelado, P: Pendiente)
     * @throws InvalidArgumentException si no es un estado válido
     */
    public function __construct(string $value)
    {
        $allowed = ['N', 'C', 'P']; // N: Vigente, C: Cancelado, P: Pendiente
        if (!in_array(strtoupper($value), $allowed)) {
            throw new InvalidArgumentException("Invalid status");
        }
        $this->value = strtoupper($value);
    }

    public function value(): string { return $this->value; }
}

