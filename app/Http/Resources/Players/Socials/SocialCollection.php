<?php

namespace App\Http\Resources\Players\Socials;

use App\Http\Resources\ResourceCollection;

class SocialCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->toArray();
    }
}
