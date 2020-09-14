<?php


namespace Atom\Validation\Constraints;

class NumericConstraint extends AbstractConstraint
{
    public function getKey(): string
    {
        return "numeric";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field must be numeric";
    }

    public function validate(string $field, array $data = []): bool
    {
        return $this->exist($field, $data) && is_numeric($this->value($field, $data));
    }
}
