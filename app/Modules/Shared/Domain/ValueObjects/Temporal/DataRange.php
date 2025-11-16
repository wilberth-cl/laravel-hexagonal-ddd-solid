<?php
namespace App\Modules\Shared\Domain\ValueObjects\Temporal;

use App\Modules\Shared\Support\Traits\IsValueObject;
use Carbon\Carbon;
use Carbon\CarbonInterval;

final class DateRange
{
    use IsValueObject;

    private Carbon $start;
    private Carbon $end;

    public function __construct(Carbon $start, Carbon $end)
    {
        if ($end->lessThan($start)) {
            throw new \InvalidArgumentException("End date must be after start date.");
        }
        $this->start = $start;
        $this->end = $end;
    }

    public function start(): Carbon { return $this->start; }
    public function end(): Carbon { return $this->end; }

    public function contains(Carbon $date): bool
    {
        return $date->between($this->start, $this->end);
    }

    public function createInterval(): CarbonInterval
    {
        return $this->start->diffAsCarbonInterval($this->end);
    }
}

