<?php

namespace App\Http\Controllers;

use App\Http\Resources\Roles\RoleCollection;
use App\Http\Resources\Roles\RoleResource;
use App\Http\Response;
use App\Services\RoleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private string $_class;
    private RoleService $_service;
    public function __construct(RoleService $service)
    {
        $this->_service = $service;
        $this->_class = $this->_service->model()::class;
    }

    public function list() : RoleCollection
    {
        $this->authorize("viewRoles", $this->_class);

        $roles = $this->_service->model()->get();
        return new RoleCollection($roles);
    }

    public function create(Request $request) : RoleResource
    {
        $this->authorize("createRole", $this->_class);

        $role = $this->_service->create($request->all());
        return new RoleResource($role);
    }

    public function get($name) : RoleResource
    {
        $this->authorize("viewRole", $this->_class);

        $role = $this->_service->find($name);
        return new RoleResource($role);
    }

    public function delete($name) : JsonResponse
    {
        $this->authorize("deleteRole", $this->_service->find($name));

        $this->_service->delete($name);
        return Response::ok();
    }

    public function grantPermission($roleName, $permissionName) : JsonResponse
    {
        $this->authorize("grantRolePermission", $this->_service->find($roleName));

        $this->_service->grantPermission($roleName, $permissionName);
        return Response::ok();
    }

    public function revokePermission($roleName, $permissionName) : JsonResponse
    {
        $this->authorize("revokeRolePermission", $this->_service->find($roleName));

        $this->_service->revokePermission($roleName, $permissionName);
        return Response::ok();
    }
}
