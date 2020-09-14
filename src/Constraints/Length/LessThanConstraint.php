<?php


namespace Atom\Validation\Constraints\Length;

use Atom\Validation\Constraints\AbstractConstraint;

class LessThanConstraint extends AbstractConstraint
{
    /**
     * @var int
     */
    private $maximum;

    public function __construct(float $maximum)
    {
        $this->maximum = $maximum;
    }

    public function validate(string $field, array $data = []): bool
    {
        return $this->lengthOf($field, $data) < $this->maximum;
    }

    public function getKey(): string
    {
        return "min";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The field $field should be less than $this->maximum";
    }

    public function getAttributes(): array
    {
        return ["maximum" => $this->maximum];
    }
}
