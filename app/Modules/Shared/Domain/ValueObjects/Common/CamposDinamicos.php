<?php

namespace App\Modules\Shared\Domain\ValueObjects\Common;

use App\Modules\Shared\Support\Traits\IsValueObject;
use InvalidArgumentException;

/**
 * Class CamposDinamicos
 *
 * Representa un conjunto de campos dinámicos de forma inmutable.
 * 
 * Estructura esperada:
 * 
 * $camposValidos = [
 *   [
 *       'nombre' => 'requerido_docs',
 *       'tipo' => 'file',
 *       'label' => 'Documentos a subir',
 *   ],
 *   [
 *       'nombre' => 'tipo_contacto',
 *       'tipo' => 'list',
 *       'label' => 'Selecciona el contacto',
 *       'lista' => [
 *           '0' => 'Correo Electrónico',
 *           '1' => 'Teléfono Móvil',
 *       ]
 *   ]
 * ];
 * 
 */
final class CamposDinamicos
{
    use IsValueObject;

    /**
     * @var array $data Los datos de los campos dinámicos
     */
    private array $data;

    /**
     * El constructor es privado para forzar la creación controlada.
     */
    private function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Metodo para validar crear un CampoDinamico desde un array
     *
     * @param array $camposData
     * @return self
     */
    public static function fromArray(array $camposData): self
    {
        // La lógica de validación estricta va aquí.
        $tiposValidos = ['text', 'file', 'list'];
        
        foreach ($camposData as $campo) {
            // 1. Validar que sea un array
            if (!is_array($campo)) {
                throw new InvalidArgumentException("Cada campo debe ser un objeto JSON.");
            }
            
            // 2. Validar campos requeridos y tipos
            if (!isset($campo['nombre']) || !is_string($campo['nombre']) || empty($campo['nombre'])) {
                throw new InvalidArgumentException("El atributo 'nombre' es requerido y debe ser string.");
            }
            if (!isset($campo['tipo']) || !in_array($campo['tipo'], $tiposValidos)) {
                throw new InvalidArgumentException("El atributo 'tipo' debe ser uno de: " . implode(', ', $tiposValidos) . ".");
            }
            if (!isset($campo['label']) || !is_string($campo['label'])) {
                throw new InvalidArgumentException("El atributo 'label' es requerido y debe ser string.");
            }

            // 3. Validar la estructura del sub-array 'lista' si el tipo es 'list'
            if ($campo['tipo'] === 'list') {
                if (!isset($campo['lista']) || !is_array($campo['lista'])) {
                    throw new InvalidArgumentException("El tipo 'list' requiere el atributo 'lista' como objeto.");
                }
                
                // Opcional: Validar la estructura interna de la lista
                foreach ($campo['lista'] as $value) {
                    // Espera una estructura tipo: "key1" => "value1"
                    if (!is_string($value)) {
                         throw new InvalidArgumentException("La estructura de 'lista' es incorrecta para el campo: " . $value);
                    }
                }
            }
        }

        return new self($camposData);
    }

    /**
     * Método para acceder a la representación de datos en array
     * @return array
     */
    public function toArray(): array
    {
        return $this->data;
    }

    /**
     * Método para acceder a la representación de datos en json
     * @return json
     */ 
    public function toJson(): string
    {
        return json_encode($this->data);
    }

    /**
     * Método para obtener un campo específico por su nombre
     * @param string $nombre
     * @return array|null
     */
    public function getCampoPorNombre(string $nombre): ?array
    {
        foreach ($this->data as $campo) {
            if ($campo['nombre'] === $nombre) {
                return $campo;
            }
        }
        return null;
    }
}