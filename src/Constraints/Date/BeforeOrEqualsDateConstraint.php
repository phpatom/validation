<?php


namespace Atom\Validation\Constraints\Date;

use Atom\Validation\Constraints\AbstractConstraint;

class BeforeOrEqualsDateConstraint extends AbstractConstraint
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
     * @throws \Exception
     */
    public function validate(string $field, array $data = []): bool
    {
        $value = $this->value($field, $data);
        return strtotime($this->date) <= strtotime($value);
    }

    public function getKey(): string
    {
        return "before|equals";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field needs to be before or equals $this->date";
    }

    public function getAttributes(): array
    {
        return ["date" => $this->date];
    }
}
