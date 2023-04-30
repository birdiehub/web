<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Controller;
use App\Http\Resources\AccessControl\RoleCollection;
use App\Http\Resources\AccessControl\RoleResource;
use App\Http\Response;
use App\Services\AccessControl\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private RoleService $_service;
    public function __construct(RoleService $service)
    {
        $this->_service = $service;
    }

    public function list() : RoleCollection
    {
        $roles = $this->_service->model()->get();
        return new RoleCollection($roles);
    }

    public function create(Request $request) : RoleResource
    {
        $role = $this->_service->create($request->all());
        return new RoleResource($role);
    }

    public function get($name) : RoleResource
    {
        $role = $this->_service->find($name);
        return new RoleResource($role);
    }

    public function delete($name) : JsonResponse
    {
        $this->_service->delete($name);
        return Response::ok();
    }

    public function grantPermission($roleName, $permissionName) : JsonResponse
    {
        $this->_service->grantPermission($roleName, $permissionName);
        return Response::ok();
    }

    public function revokePermission($roleName, $permissionName) : JsonResponse
    {
        $this->_service->revokePermission($roleName, $permissionName);
        return Response::ok();
    }
}
