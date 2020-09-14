<?php
namespace Atom\Validation\Translation;

use Atom\Validation\Contracts\TranslationBagContract;

class TranslationBag implements TranslationBagContract
{
    /**
     * @var array[]
     */
    private $translations;
    public function __construct($translations = [])
    {
        $this->translations = $translations;
    }

    public function add(string $key, string $translation):void
    {
        $this->translations[$key] = $translation;
    }

    public function hasTranslation(string $key):bool
    {
        return array_key_exists($key, $this->translations);
    }

    public function translate(string $key, array $attributes = [], ?string $fallback = null): string
    {
        if (!$this->hasTranslation($key)) {
            return $fallback ?? $key;
        }
        $result = $this->getTranslation($key);
        foreach ($attributes as $key => $value) {
            $result = str_replace(":".$key, $value, $result);
        }
        return $result;
    }

    /**
     * @return array[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }

    private function getTranslation(string $key):string
    {
        return $this->translations[$key];
    }
}
