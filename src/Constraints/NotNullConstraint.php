<?php
namespace Atom\Validation\Constraints;

class NotNullConstraint extends AbstractConstraint
{
    public function getKey(): string
    {
        return "!null";
    }

    public function getFallbackErrorMessage(string $fieldName): string
    {
        return "The field $fieldName should not be null";
    }

    public function validate(string $field, array $data = []): bool
    {
        return $this->exist($field, $data) && !is_null($this->value($field, $data));
    }
}
