<?php

namespace Pasoonate;

class Localization
{
    public $langs;
    public $locale;

    public function __construct()
    {
        $this->langs = [];
        $this->locale = 'fa';
    }

    public function setLang($name, $trans)
    {
        $this->langs[$name] = $trans;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function setLocale($locale)
    {
        $this->locale = $locale ?? $this->locale;
    }

    public function isLocale($locale)
    {
        return $this->locale === $locale;
    }  
    
    public function hasTransKey($key, $locale)
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

    public function getTrans($key, $locale)
    {
        $result = $this->hasTransKey($key, $locale);

        return $result ? $result : $key;
    }

    public function trans($key, $locale)
    {
        $locale = $locale ?? $this->locale;
        $key = $key ?? '';

        return $this->getTrans($key, $locale);
    }
}