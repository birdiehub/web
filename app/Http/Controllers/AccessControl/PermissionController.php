<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessControl\PermissionCollection;
use App\Http\Resources\AccessControl\PermissionResource;
use App\Http\Response;
use App\Services\AccessControl\PermissionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
