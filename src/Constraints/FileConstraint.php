<?php


namespace Atom\Validation\Constraints;

class FileConstraint extends AbstractConstraint
{

    public function validate(string $field, array $data = []): bool
    {
        return $this->isFile($this->value($field, $data));
    }

    public function getKey(): string
    {
        return "file";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field should be a file";
    }
}
