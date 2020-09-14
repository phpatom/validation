<?php


namespace Atom\Validation\Constraints;

class PatternMismatchConstraint extends PatternMatchConstraint
{
    public function validate(string $field, array $data = []): bool
    {
        return !parent::validate($field, $data);
    }

    public function getKey(): string
    {
        return "!match";
    }
}
