<?php

namespace Pasoonate;

class Localization
{
    public $_langs;
    public $_locale;

    public function __construct()
    {
        $this->_langs = [];
        $this->_locale = 'fa';
    }

    public function setLang($name, $trans)
    {
        $this->_langs[$name] = $trans;
    }

    public function getLocale()
    {
        return $this->_locale;
    }

    public function setLocale($locale)
    {
        $this->_locale = $locale ?? $this->_locale;
    }

    public function isLocale($locale)
    {
        return $this->_locale === $locale;
    }

    public function trans($key, $locale)
    {
        $locale = $locale ?? $this->_locale;
        $key = $key ?? '';
        return $this->getTrans($key, $locale);
    }

    public function getTrans($key, $locale)
    {
        $result = $this->hasTransKey($key, $locale);
        return $result ? $result : $key;
    }

    public function hasTransKey($key, $locale)
    {
        $subKeys = explode('.', $key);

        if (!isset($this->_langs[$locale])) {
            return false;
        }
        
        $result = $this->_langs[$locale];

        for ($i = 0; $i < count($subKeys); $i++) {
            if (isset($result[$subKeys[$i]])) {
                $result = $result[$subKeys[$i]];
                continue;
            }

            return false;
        }

        return $result;
    }
}