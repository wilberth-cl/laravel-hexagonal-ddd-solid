<?php
namespace App\Modules\Shared\Domain\ValueObjects\Contact;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Value Object PhoneNumber
 */
final class PhoneNumber
{
    use IsValueObject;

    private string $value;

    public function __construct(string $number)
    {
        $cleaned = preg_replace('/\D+/', '', $number);
        if (strlen($cleaned) < 7 || strlen($cleaned) > 15) {
            throw new \InvalidArgumentException("Invalid phone number");
        }
        $this->value = $cleaned;
    }

    public function value(): string { return $this->value; }
}
