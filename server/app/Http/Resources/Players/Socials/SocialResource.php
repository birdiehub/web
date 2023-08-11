<?php

namespace App\Http\Resources\Players\Socials;

use App\Http\Resources\Resource;

class SocialResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'channel' => $this->channel,
            'url' => $this->url
        ];
    }
}
