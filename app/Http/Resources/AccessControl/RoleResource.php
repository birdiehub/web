<?php

namespace App\Http\Resources\AccessControl;

use App\Http\Resources\Resource;

class RoleResource extends Resource
{
    public function toArray($request) : array
    {
        return [
            'name' => $this->name,
            'permissions' => new PermissionCollection($this->permissions)
        ];
    }
}
