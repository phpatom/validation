<?php


namespace Atom\Validation\Constraints\Date;

use Atom\Validation\Constraints\AbstractConstraint;

class DateEqualsConstraint extends AbstractConstraint
{

    /**
     * @var string
     */
    private $date;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function validate(string $field, array $data = []): bool
    {
        return  strtotime($this->value($field, $data)) == strtotime($this->date);
    }

    public function getKey(): string
    {
        return "date|equals";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field needs to be equals to $this->date";
    }

    public function getAttributes(): array
    {
        return ["date" => $this->date];
    }
}
