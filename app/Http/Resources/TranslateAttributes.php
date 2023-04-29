<?php

namespace App\Http\Resources;

trait TranslateAttributes
{
    public function translate(string $attribute, bool $useFallbackLocale = true): string | null
    {
        $translation = $this->resource->translate($attribute, $this->_language ?? "", $useFallbackLocale);
        return $translation === "" ? null : $translation;
    }
}
