<?php


namespace Atom\Validation\Constraints;

class AlphabeticOnlyConstraint extends AbstractConstraint
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
        return strlen($value) >= 1 && ctype_alpha($value);
    }

    public function getKey(): string
    {
        return "alpha";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field should contains only alphabetic character";
    }
}
