<?php
namespace App\Modules\Shared\Support\Traits;

/**
 * Trait IsValueObject
 * Proporciona funcionalidades comunes para Value Objects
 */
trait IsValueObject
{
    public function equals(object $other): bool
    {
        if (! $other instanceof self) return false;
        return get_object_vars($this) === get_object_vars($other);
    }

    public function __toString(): string
    {
        return json_encode(get_object_vars($this));
    }
}