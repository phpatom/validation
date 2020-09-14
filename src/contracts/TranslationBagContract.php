<?php


namespace Atom\Validation\Contracts;

interface TranslationBagContract
{
    public function translate(string $key, array $attributes = [], ?string $fallback = null): string;
}
