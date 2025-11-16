<?php

namespace Domain\ValueObject;

class Curp
{
    private string $value;

    public function __construct(string $value)
    {
        $this->validate($value);
        $this->value = strtoupper($value); // Asegurar mayúsculas como estándar
    }

    private function validate(string $value): void
    {
        // Expresión regular oficial para validar CURP
        $pattern = '/^[A-Z]{4}\d{6}[HM][A-Z]{5}[A-Z0-9]\d$/';

        if (!preg_match($pattern, $value)) {
            throw new \InvalidArgumentException("Invalid CURP format.");
        }

        // Validar fecha en el CURP
        $birthDate = substr($value, 4, 6);
        $this->validateDate($birthDate);
    }

    private function validateDate(string $birthDate): void
    {
        $year = intval(substr($birthDate, 0, 2)); // Año (dos dígitos)
        $month = intval(substr($birthDate, 2, 2)); // Mes
        $day = intval(substr($birthDate, 4, 2)); // Día

        // Determinar el siglo en función del rango de años (asume que las personas nacen entre 1900 y 2099)
        $century = $year >= 0 && $year <= 23 ? 2000 : 1900; // Según el estándar CURP oficial

        $fullYear = $century + $year;

        if (!checkdate($month, $day, $fullYear)) {
            throw new \InvalidArgumentException("Invalid date in CURP.");
        }
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}