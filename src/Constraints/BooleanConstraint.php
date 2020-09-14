<?php


namespace Atom\Validation\Constraints;

use Exception;

class BooleanConstraint extends AbstractConstraint
{

    /**
     * @param string $field
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function validate(string $field, array $data = []): bool
    {
        $value = $this->value($field, $data);
        return is_bool($value) || $value === 1 ||
            $value === 0 || $value === "1" || $value === "0";
    }

    public function getKey(): string
    {
        return "boolean";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field should be a boolean";
    }
}
