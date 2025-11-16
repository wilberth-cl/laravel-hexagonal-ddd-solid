<?php
namespace App\Modules\Shared\Domain\ValueObjects\Identity;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Value Object Slug
 */
final class Slug
{
    use IsValueObject;

    private string $value;

    public function __construct(string $value)
    {
        $this->value = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value), '-'));
    }

    public function value(): string { return $this->value; }
}
