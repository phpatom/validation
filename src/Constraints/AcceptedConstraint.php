<?php


namespace Atom\Validation\Constraints;

class AcceptedConstraint extends AbstractConstraint
{

    public function validate(string $field, array $data = []): bool
    {
        if (!$this->exist($field, $data)) {
            return false;
        }
        $value = strtolower((string)$this->value($field, $data));
        return $value === "yes" || $value === "on" || $value == "1" || $value === "true";
    }

    public function getKey(): string
    {
        return "accepted";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "You need to accept $field";
    }
}
