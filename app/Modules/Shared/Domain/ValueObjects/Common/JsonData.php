<?php

namespace App\Modules\Shared\Domain\ValueObjects\Common;

use App\Modules\Shared\Support\Traits\IsValueObject;
use InvalidArgumentException;

/**
 * Class JsonData
 *
 * Value Object que representa datos JSON.
 */
final class JsonData
{
    use IsValueObject;

    private array $data;

    /**
     * JsonData constructor.
     *
     * @param array|string $data Arreglo o string JSON
     * @throws InvalidArgumentException si no es JSON válido
     */
    public function __construct(array|string $data)
    {
        if (is_string($data)) {
            $decoded = json_decode($data, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new InvalidArgumentException("Invalid JSON string");
            }
            $this->data = $decoded;
        } else {
            $this->data = $data;
        }
    }

    public function data(): array { return $this->data; }

    public function toJson(): string
    {
        return json_encode($this->data);
    }
}

