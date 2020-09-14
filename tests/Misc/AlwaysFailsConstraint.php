<?php


namespace Atom\Validation\Test\Misc;

use Atom\Validation\Constraints\AbstractConstraint;

class AlwaysFailsConstraint extends AbstractConstraint
{
    /**
     * @var string
     */
    private $message;
    /**
     * @var string
     */
    private $key;

    public function __construct(string $message = "fails", $key = "fails")
    {
        $this->message = $message;
        $this->key = $key;
    }

    public function validate(string $field, array $data = []): bool
    {
        return false;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getFallbackErrorMessage(string $field): string
    {
        return  $this->message;
    }
}
