<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection as JsonResourceCollection;

abstract class ResourceCollection extends JsonResourceCollection
{

    protected string | null $_language;
    public function __construct($resource)
    {
        parent::__construct($resource);
        $this->_language = app()->getLocale();
    }

}
