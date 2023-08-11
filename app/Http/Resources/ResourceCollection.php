<?php

namespace App\Http\Resources;

use App\Traits\TranslatableAttributes;
use Illuminate\Http\Resources\Json\ResourceCollection as JsonResourceCollection;

abstract class ResourceCollection extends JsonResourceCollection
{

    use TranslatableAttributes;

    protected string | null $_language;
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->_language = app()->getLocale();
    }

    // because we are using a collection, we don't have access to the exact model,
    // so we need to pass it in as a parameter
    protected function translate($model, string $attribute, bool $useFallbackLocale = true): string | null
    {
        return $this->translateAttribute($model, $this->_language, $attribute, $useFallbackLocale);
    }

}
