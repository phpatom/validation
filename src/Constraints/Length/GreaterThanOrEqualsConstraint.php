<?php

namespace Atom\Validation\Constraints\Length;

use Atom\Validation\Constraints\AbstractConstraint;

class GreaterThanOrEqualsConstraint extends AbstractConstraint
{
    /**
     * @var int
     */
    private $minimum;

    public function __construct(float $minimum)
    {
        $this->minimum = $minimum;
    }

    public function validate(string $field, array $data = []): bool
    {
        return $this->lengthOf($field, $data) <= $this->minimum;
    }

    public function getKey(): string
    {
        return "max|equals";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The field $field must be greater than or equals to to $this->minimum ";
    }

    public function getAttributes(): array
    {
        return ["minimum" => $this->minimum];
    }
}
