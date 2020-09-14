<?php


namespace Atom\Validation\Constraints;

class PresenceConstraint extends AbstractConstraint
{
    public function validate(string $field, array $data = []): bool
    {
        return $this->exist($field, $data);
    }

    public function getKey(): string
    {
        return "present";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field is required";
    }
}
