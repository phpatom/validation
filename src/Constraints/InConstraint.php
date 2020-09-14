<?php


namespace Atom\Validation\Constraints;

class InConstraint extends AbstractConstraint
{
    /**
     * @var array
     */
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function validate(string $field, array $data = []): bool
    {
        return in_array($this->value($field, $data), $this->array);
    }

    public function getKey(): string
    {
        return "in";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The value of $field is not valid";
    }

    public function getAttributes(): array
    {
        return ["array" => implode($this->array, ",")];
    }
}
