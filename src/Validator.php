<?php

namespace Atom\Validation;

use Atom\Validation\Contracts\ValidatorContract;
use Atom\Validation\Exceptions\ValidationException;
use Atom\Validation\Translation\TranslationBag;
use Psr\Http\Message\ServerRequestInterface;

class Validator implements ValidatorContract
{
    /**
     * @var array[]
     */
    private $errors = [];
    /**
     * @var TranslationBag
     */
    private $translations;
    /**
     * @var Expectation[]
     */
    private $expectations = [];

    public function __construct(?TranslationBag $translations = null)
    {
        $this->translations = $translations ?? new TranslationBag();
    }

    /**
     * @param ServerRequestInterface $request
     * @throws ValidationException
     */
    public function validate(ServerRequestInterface $request): void
    {
        $this->check($request);
        if ($this->hasErrors()) {
            throw new ValidationException($this->errors);
        }
    }

    /**
     * @param ServerRequestInterface $request
     */
    public function check(ServerRequestInterface $request):void
    {
        foreach ($this->expectations as $expectation) {
            if (!$expectation->isSatisfiedBy($request, $this->translations)) {
                $this->errors[$expectation->getField()] = $expectation->getErrors();
            }
        }
    }

    /**
     * @return bool
     */
    public function succeed()
    {
        return !$this->hasErrors();
    }

    /**
     * @return bool
     */
    public function failed()
    {
        return !$this->succeed();
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return !empty($this->errors);
    }

    /**
     * @param string $field
     * @param string|null $fieldName
     * @return Expectation
     */
    public function assert(string $field, ?string $fieldName = null): Expectation
    {
        $expectation = new Expectation($field, $fieldName);
        $this->add($expectation);
        return $expectation;
    }

    public function add(Expectation $expectation): self
    {
        $this->expectations[] = $expectation;
        return $this;
    }

    /**
     * @return TranslationBag
     */
    public function translations(): TranslationBag
    {
        return $this->translations;
    }

    /**
     * @param TranslationBag $translations
     */
    public function setTranslations(TranslationBag $translations): void
    {
        $this->translations = $translations;
    }

    /**
     * @param string|null $field
     * @return string[]
     */
    public function errors(?string $field = null): array
    {
        if (!$field) {
            return $this->errors;
        }
        if ($field && array_key_exists($field, $this->errors)) {
            return $this->errors[$field];
        }
        return [];
    }

    /**
     * @return Expectation[]
     */
    public function getExpectations(): array
    {
        return $this->expectations;
    }
}
