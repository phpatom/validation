<?php


namespace Atom\Validation\Constraints;

class FilledConstraint extends AbstractConstraint
{

    public function validate(string $field, array $data = []): bool
    {
        return $this->isNotEmpty($field, $data);
    }

    public function getKey(): string
    {
        return "filled";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The field $field should be filled";
    }
}
