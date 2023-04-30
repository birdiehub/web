<?php

namespace App\Http\Resources\AccessControl;

use App\Http\Resources\Resource;

class PermissionResource extends Resource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name
        ];
    }
}
