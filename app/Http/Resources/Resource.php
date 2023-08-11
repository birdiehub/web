<?php

namespace App\Http\Resources;

use App\Traits\TranslatableAttributes;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class Resource extends JsonResource
{
    use TranslatableAttributes;

    protected string | null $_language;
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->_language = app()->getLocale();
    }

    protected function translate(string $attribute, bool $useFallbackLocale = true): string | null
    {
        return $this->translateAttribute($this->resource, $this->_language, $attribute, $useFallbackLocale);
    }

}

