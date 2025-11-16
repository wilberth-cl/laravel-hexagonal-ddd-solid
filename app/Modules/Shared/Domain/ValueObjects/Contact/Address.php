<?php

namespace App\Modules\Shared\Domain\ValueObjects\Contact;

use App\Modules\Shared\Support\Traits\IsValueObject;

/**
 * Value Object Address
 */
final class Address
{
    use IsValueObject;

    private string $street;
    private string $city;
    private string $zip;
    private string $country;

    public function __construct(string $street, string $city, string $zip, string $country)
    {
        $this->street = $street;
        $this->city = $city;
        $this->zip = $zip;
        $this->country = strtoupper($country);
    }

    public function street(): string { return $this->street; }
    public function city(): string { return $this->city; }
    public function zip(): string { return $this->zip; }
    public function country(): string { return $this->country; }
}
