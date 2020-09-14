<?php


namespace Atom\Validation\Constraints;

class DifferenceConstraint extends AbstractConstraint
{
    /**
     * @var string
     */
    private $otherField;

    public function __construct(string $otherField)
    {
        $this->otherField = $otherField;
    }

    /**
     * @param string $field
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function validate(string $field, array $data = []): bool
    {
        return $this->value($field, $data) !== $this->value($this->otherField, $data);
    }

    public function getKey(): string
    {
        return "different";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The value of the field $field and $this->otherField should be different";
    }

    public function getAttributes(): array
    {
        return  ["value" => $this->otherField];
    }
}
