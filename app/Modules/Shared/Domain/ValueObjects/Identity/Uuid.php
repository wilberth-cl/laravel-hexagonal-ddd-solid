<?php
namespace App\Modules\Shared\Domain\ValueObjects\Identity;

use App\Modules\Shared\Support\Traits\IsValueObject;
use Ramsey\Uuid\Uuid as RamseyUuid;

/**
 * Value Object UUID
 */
final class Uuid
{
    use IsValueObject;

    private string $value;

    public function __construct(string $value = null)
    {
        $this->value = $value ?? RamseyUuid::uuid4()->toString();
    }

    public function value(): string { return $this->value; }
}
