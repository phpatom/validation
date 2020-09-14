<?php


namespace Atom\Validation\Constraints\Date;

use Atom\Validation\Constraints\AbstractConstraint;
use DateTime;

class DateFormatConstraint extends AbstractConstraint
{
    /**
     * @var string
     */
    private $format;

    public function __construct(string $format)
    {
        $this->format = $format;
    }

    public function validate(string $field, array $data = []): bool
    {
        $date = $this->value($field, $data);
        $dateTime = DateTime::createFromFormat($this->format, $date);
        return $dateTime && $dateTime->format($this->format) === $date;
    }

    public function getKey(): string
    {
        return "date|format";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "$field should be a date that match the format $this->format";
    }

    public function getAttributes(): array
    {
        return ["format" => $this->format];
    }
}
