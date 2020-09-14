<?php


namespace Atom\Validation\Constraints;

class AlphaNumericOnlyConstraint extends AbstractConstraint
{
    /**
     * @param string $field
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function validate(string $field, array $data = []): bool
    {
        $value = $this->value($field, $data);
        return strlen($value) >= 1 && ctype_alnum($value);
    }

    public function getKey(): string
    {
        return "alpha|num";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field should contains only alphabetic or numeric character";
    }
}
