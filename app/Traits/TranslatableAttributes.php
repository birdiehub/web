<?php

namespace App\Traits;

trait TranslatableAttributes
{
    protected function translateAttribute($model, $language, string $attribute, bool $useFallbackLocale = true): string | null
    {
        $translation = $model->getTranslation($attribute, $language ?? "", $useFallbackLocale);
        return $translation === "" ? null : $translation;
    }
}
