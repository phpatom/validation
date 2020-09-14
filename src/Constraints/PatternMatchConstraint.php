<?php


namespace Atom\Validation\Constraints;

class PatternMatchConstraint extends AbstractConstraint
{
    /**
     * @var string
     */
    private $pattern;

    public function __construct(string $pattern)
    {
        $this->pattern = $pattern;
    }

    public function validate(string $field, array $data = []): bool
    {
        return preg_match($this->pattern, $this->value($field, $data));
    }

    public function getKey(): string
    {
        return "match";
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return "The field $field is not valid";
    }

    public function getAttributes(): array
    {
        return ["^pattern" => $this->pattern];
    }
}
