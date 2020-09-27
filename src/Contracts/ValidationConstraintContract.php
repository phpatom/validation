<?php
namespace  Atom\Validation\Contracts;

interface ValidationConstraintContract
{
    public function check($field, array $data = []) : ?string;
    public function getKey():string;
    public function getFallbackErrorMessage(string $field): string;
    public function getAttributes(): array;
}
