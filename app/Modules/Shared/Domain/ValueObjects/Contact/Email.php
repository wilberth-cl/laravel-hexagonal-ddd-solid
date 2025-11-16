<?php

namespace App\Modules\Shared\Domain\ValueObjects\Contact;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Value Object Email
 */
final class Email
{
    use IsValueObject;

    private string $value;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email");
        }
        $this->value = strtolower($email);
    }

    public function value(): string { return $this->value; }
}
