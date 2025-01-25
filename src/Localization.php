<?php

declare(strict_types=1);

namespace Pasoonate;

class Localization
{
    public function __construct(
        public array  $langs = [],
        public string $locale = 'fa'
    )
    {
    }

    public function setLang(string $name, array $trans): void
    {
        $this->langs[$name] = $trans;
    }

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): void
    {
        $this->locale = $locale;
    }

    public function isLocale(string $locale): bool
    {
        return $this->locale === $locale;
    }

    public function hasTransKey(string $key, string $locale): false|string
    {
        $subKeys = explode('.', $key);

        if (!isset($this->langs[$locale])) {
            return false;
        }

        $result = $this->langs[$locale];

        for ($i = 0; $i < count($subKeys); $i++) {
            if (isset($result[$subKeys[$i]])) {
                $result = $result[$subKeys[$i]];
                continue;
            }

            return false;
        }

        return $result;
    }

    public function getTrans(string $key, string $locale): string
    {
        $result = $this->hasTransKey($key, $locale);

        return $result !== false ? $result : $key;
    }

    public function trans(string|null $key = null, string|null $locale = null): string
    {
        $locale = $locale ?? $this->locale;
        $key = $key ?? '';

        return $this->getTrans($key, $locale);
    }
}