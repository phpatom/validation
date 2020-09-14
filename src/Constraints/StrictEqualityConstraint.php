<?php


namespace Atom\Validation\Constraints;

class StrictEqualityConstraint extends EqualityConstraint
{
    public function validate(string $field, array $data = []): bool
    {
        return $this->value($field, $data) === $this->value;
    }

    public function getKey(): string
    {
        return "strictly_equals";
    }
}
