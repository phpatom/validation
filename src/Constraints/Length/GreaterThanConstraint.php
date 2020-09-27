<?php

namespace Atom\Validation\Constraints\Length;

use Atom\Validation\Constraints\AbstractConstraint;

class GreaterThanConstraint extends AbstractConstraint
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
        return $this->lengthOf($field, $data) < $this->minimum;
    }

    public function getKey(): string
    {
        return "min";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The field $field should be greater than $this->minimum";
    }

    public function getAttributes(): array
    {
        return ["minimum" => $this->minimum];
    }
}
