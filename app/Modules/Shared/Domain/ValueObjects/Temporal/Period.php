<?php
namespace App\Modules\Shared\Domain\ValueObjects\Temporal;

use App\Modules\Shared\Support\Traits\IsValueObject;
use Carbon\CarbonInterval;

/**
 * Class Period
 *
 * Representa un intervalo de tiempo.
 */
final class Period
{
    use IsValueObject;

    private CarbonInterval $interval;

    /**
     * @param CarbonInterval|string $interval Intervalo de tiempo
     */
    public function __construct(CarbonInterval|string $interval)
    {
        $this->interval = $interval instanceof CarbonInterval ? $interval : CarbonInterval::make($interval);
    }

    public function interval(): CarbonInterval
    {
        return $this->interval->cascade(); // asegura días, horas, minutos normalizados
    }

    /**
     * Devuelve la duración total en días
     */
    public function totalDays(): int
    {
        return (int)$this->interval->totalDays;
    }

    /**
     * Devuelve la duración total en segundos
     */
    public function totalSeconds(): int
    {
        return $this->interval->totalSeconds;
    }
}

