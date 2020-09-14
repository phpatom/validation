<?php


namespace Atom\Validation\Constraints;

class NotInConstraint extends InConstraint
{
    public function validate(string $field, array $data = []): bool
    {
        return !parent::validate($field, $data);
    }

    public function getKey(): string
    {
        return "!in";
    }

}
