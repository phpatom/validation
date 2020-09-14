<?php


namespace Atom\Validation\Constraints\Length;

use Atom\Validation\Constraints\AbstractConstraint;

class LessThanOrEqualsConstraint extends AbstractConstraint
{
    /**
     * @var float
     */
    private $maximum;

    public function __construct(float $maximum)
    {
        $this->maximum = $maximum;
    }

    public function validate(string $field, array $data = []): bool
    {
        return $this->lengthOf($field, $data) <= $this->maximum;
    }

    public function getKey(): string
    {
        return "min|equals";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The field $field should be less than or equals to $this->maximum";
    }

    public function getAttributes(): array
    {
        return ["maximum" => $this->maximum];
    }
}
