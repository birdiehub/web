<?php

namespace App\Http\Controllers;

use App\Http\Resources\Permissions\PermissionCollection;
use App\Http\Resources\Permissions\PermissionResource;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    private PermissionService $_service;
    public function __construct(PermissionService $permissionService)
    {
        $this->_service = $permissionService;
    }

    public function list() : PermissionCollection
    {
        $permissions = $this->_service->model()->get();
        return new PermissionCollection($permissions);
    }

    public function get($name) : PermissionResource
    {
        $permission = $this->_service->find($name);
        return new PermissionResource($permission);
    }
}
