<?php


namespace Atom\Validation\Constraints\Date;

use Atom\Validation\Constraints\AbstractConstraint;

class DateConstraint extends AbstractConstraint
{

    public function validate(string $field, array $data = []): bool
    {
        return $this->exist($field, $data) && (bool)strtotime($this->value($field, $data));
    }

    public function getKey(): string
    {
        return "date";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field is not a valid date";
    }
}
