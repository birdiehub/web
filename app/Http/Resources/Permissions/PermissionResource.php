<?php

namespace App\Http\Resources\Permissions;

use App\Http\Resources\Resource;

class PermissionResource extends Resource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'description' => $this->description ?? null,
            'group' => $this->group ?? null
        ];
    }
}
