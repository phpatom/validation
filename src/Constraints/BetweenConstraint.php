<?php


namespace Atom\Validation\Constraints;

class BetweenConstraint extends AbstractConstraint
{
    /**
     * @var float
     */
    private $min;
    /**
     * @var float
     */
    private $max;
    public function __construct(float $min, float $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param string $field
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function validate(string $field, array $data = []): bool
    {
        $length = $this->lengthOf($field, $data);
        return $this->min <= $length  && $length <= $this->max;
    }

    public function getKey(): string
    {
        return "between";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The length/size of $field must be between $this->min, and $this->max";
    }

    public function getAttributes(): array
    {
        return ['min' => $this->min, "max" => $this->max];
    }
}
