<?php


namespace Atom\Validation\Test\Misc;

use Atom\Validation\Constraints\AbstractConstraint;

class AlwaysPassesConstraint extends AbstractConstraint
{

    public function validate(string $field, array $data = []): bool
    {
        return true;
    }

    public function getKey(): string
    {
        return "passes";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "passes";
    }
}
