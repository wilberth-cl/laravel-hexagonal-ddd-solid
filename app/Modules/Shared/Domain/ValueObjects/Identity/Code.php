<?php
namespace App\Modules\Shared\Domain\ValueObjects\Identity;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Value Object Code
 */
final class Code
{
    use IsValueObject;

    private string $value;

    public function __construct(string $value)
    {
        if (!preg_match('/^[A-Z0-9_-]{3,20}$/', $value)) {
            throw new \InvalidArgumentException("Invalid code format");
        }
        $this->value = $value;
    }

    public function value(): string { return $this->value; }
}
