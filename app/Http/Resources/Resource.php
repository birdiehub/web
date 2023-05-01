<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class Resource extends JsonResource
{

    protected string | null $_language;
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->_language = app()->getLocale();
    }

    protected function translate(string $attribute, bool $useFallbackLocale = true): string | null
    {
        $translation = $this->resource->getTranslation($attribute, $this->_language ?? "", $useFallbackLocale);
        return $translation === "" ? null : $translation;
    }

}

