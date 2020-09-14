<?php


namespace Atom\Validation\Constraints;

class IntegerConstraint extends AbstractConstraint
{

    public function validate(string $field, array $data = []): bool
    {
        return is_int($this->value($field, $data));
    }

    public function getKey(): string
    {
        return "integer";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field should be an integer";
    }
}
