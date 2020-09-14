<?php


namespace Atom\Validation\Constraints;

class EmailConstraint extends AbstractConstraint
{

    /**
     * @param string $field
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function validate(string $field, array $data = []): bool
    {
        return filter_var($this->value($field, $data), FILTER_VALIDATE_EMAIL);
    }

    public function getKey(): string
    {
        return "email";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The field $field should be a valid email";
    }
}
