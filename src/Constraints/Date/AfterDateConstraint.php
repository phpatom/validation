<?php


namespace Atom\Validation\Constraints\Date;

use Atom\Validation\Constraints\AbstractConstraint;
use Exception;

class AfterDateConstraint extends AbstractConstraint
{
    /**
     * @var string
     */
    private $date;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    /**
     * @param string $field
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function validate(string $field, array $data = []): bool
    {
        $value = $this->value($field, $data);
        return strtotime($this->date) > strtotime($value);
    }

    public function getKey(): string
    {
        return "after";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$this->date needs to be after $field";
    }

    public function getAttributes(): array
    {
        return ["date" => $this->date];
    }

}
