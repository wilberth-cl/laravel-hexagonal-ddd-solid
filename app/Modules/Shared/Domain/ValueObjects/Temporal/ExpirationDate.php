<?php
namespace App\Modules\Shared\Domain\ValueObjects\Temporal;

use App\Modules\Shared\Support\Traits\IsValueObject;
use Carbon\Carbon;

/**
 * Class ExpirationDate
 *
 * Representa una fecha de expiración.
 */
final class ExpirationDate
{
    use IsValueObject;

    private Carbon $date;

    /**
     * @param Carbon|string $date Fecha de expiración
     */
    public function __construct(Carbon|string $date)
    {
        $this->date = $date instanceof Carbon ? $date->copy() : new Carbon($date);
    }

    public function date(): Carbon
    {
        return $this->date->copy();
    }

    /**
     * Verifica si la fecha ha expirado respecto a hoy
     */
    public function isExpired(): bool
    {
        return $this->date->isPast();
    }

    /**
     * Calcula la diferencia en días respecto a otra fecha (por defecto hoy)
     */
    public function daysUntil(Carbon $reference = null): int
    {
        $ref = $reference ?? Carbon::now();
        return $ref->diffInDays($this->date, false);
    }
}

