<?php

namespace App\Http\Resources\Players\Snapshots;

use App\Http\Resources\Resource;

class SnapshotResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->translate('title'),
            'value' => $this->translate('value'),
            'description' => $this->translate('description')
        ];
    }
}
