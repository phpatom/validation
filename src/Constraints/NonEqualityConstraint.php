<?php


namespace Atom\Validation\Constraints;

class NonEqualityConstraint extends EqualityConstraint
{
    public function validate(string $field, array $data = []): bool
    {
        return !parent::validate($field, $data);
    }

    public function getKey(): string
    {
        return "!equals";
    }
}
