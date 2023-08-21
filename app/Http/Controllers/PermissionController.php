<?php

namespace App\Http\Controllers;

use App\Http\Resources\Permissions\PermissionCollection;
use App\Http\Resources\Permissions\PermissionResource;
use App\Services\PermissionService;

class PermissionController extends Controller
{

    private string $_class;
    private PermissionService $_service;
    public function __construct(PermissionService $permissionService)
    {
        $this->_service = $permissionService;
        $this->_class = $this->_service->model()::class;
    }

    public function list() : PermissionCollection
    {
        $this->authorize("viewPermissions", $this->_class);

        $permissions = $this->_service->model()->get();
        return new PermissionCollection($permissions);
    }

    public function get($name) : PermissionResource
    {
        $this->authorize("viewPermission", $this->_class);

        $permission = $this->_service->find($name);
        return new PermissionResource($permission);
    }
}
