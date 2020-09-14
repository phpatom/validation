<?php

namespace Atom\Validation;

use Atom\Validation\Contracts\ValidationConstraintContract;
use Atom\Validation\Contracts\ValidationScopeContract;
use Atom\Validation\Translation\TranslationBag;
use Psr\Http\Message\ServerRequestInterface;

class Expectation
{
    /**
     * @var string
     */
    private $field;
    /**
     * @var ValidationConstraintContract[]
     */
    private $constraints = [];
    /**
     * @var string
     */
    private $fieldName;
    /**
     * @var array
     */
    private $errors = [];

    private $scope;

    /**
     * Expectation constructor.
     * @param string $field
     * @param string|null $fieldName
     * @param array $constraints
     * @param ValidationScopeContract|null $scope
     */
    public function __construct(
        string $field,
        ?string $fieldName = null,
        array $constraints = [],
        ?ValidationScopeContract $scope = null
    ) {
        $this->field = $field;
        $this->fieldName = $fieldName ?? ucwords($field);
        $this->scope = $scope ?? Scope::body();
        foreach ($constraints as $constraint) {
            $this->addConstraint($constraint);
        }
    }

    public function addConstraint(ValidationConstraintContract $constraint): self
    {
        $this->constraints[] = $constraint;
        return $this;
    }

    public function isSatisfiedBy(ServerRequestInterface $request, TranslationBag $bag): bool
    {
        foreach ($this->constraints as $constraint) {
            $error = $constraint->check($this->field, $this->scope->dataOf($request));
            if ($error !== null) {
                $translationData = array_merge(["label" => $constraint->getKey()], $constraint->getAttributes());
                $this->errors[$constraint->getKey()] = $bag->translate(
                    $this->getField(). "." . $error,
                    $translationData,
                    $bag->translate(
                        $error,
                        $translationData,
                        $constraint->getFallbackErrorMessage($this->getFieldName())
                    )
                );
            }
        }
        return empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return ConstraintFactory
     */
    public function is(): ConstraintFactory
    {
        return new ConstraintFactory($this);
    }

    public function onQueryParams(): self
    {
        return $this->on(Scope::queryParams());
    }

    public function on(ValidationScopeContract $scope): self
    {
        $this->scope = $scope;
        return $this;
    }

    public function onBody(): self
    {
        $this->scope = Scope::body();
        return $this;
    }

    /**
     * @return string
     */
    public function getFieldName(): string
    {
        return $this->fieldName;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return ValidationConstraintContract[]
     */
    public function getConstraints(): array
    {
        return $this->constraints;
    }

    /**
     * @return ValidationScopeContract|Scopes\RequestBodyScope|null
     */
    public function getScope()
    {
        return $this->scope;
    }
}
