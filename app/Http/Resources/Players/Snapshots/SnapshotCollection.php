<?php

namespace App\Http\Resources\Players\Snapshots;

use App\Http\Resources\ResourceCollection;

class SnapshotCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->toArray();
    }
}
