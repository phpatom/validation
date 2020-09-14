<?php

namespace Atom\Validation\Constraints;

class EqualityConstraint extends AbstractConstraint
{
    protected $value;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function validate(string $field, array $data = []): bool
    {
        return $this->value($field, $data) == $this->value;
    }

    public function getKey(): string
    {
        return "equals";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The field $field is not valid";
    }

    public function getAttributes(): array
    {
        return ["value" => $this->value];
    }
}
