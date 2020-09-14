<?php


namespace Atom\Validation\Constraints;

class ArrayConstraint extends AbstractConstraint
{
    /**
     * @param string $field
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function validate(string $field, array $data = []): bool
    {
        return is_array($this->value($field, $data));
    }

    public function getKey(): string
    {
        return "array";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field needs to be an array";
    }
}
