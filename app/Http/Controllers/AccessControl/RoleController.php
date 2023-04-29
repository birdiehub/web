<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Controller;
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

    public function all() : JsonResponse
    {
        $roles = $this->_service->all();
        return Response::json(["data" => $roles]);
    }

    public function list() : JsonResponse
    {
        $roles = $this->_service->list();
        return Response::json(["data" => $roles]);
    }

    public function create(Request $request) : JsonResponse
    {
        $role = $this->_service->create($request->all());
        return Response::json(["data" => $role]);
    }

    public function get($name) : JsonResponse
    {
        $role = $this->_service->get($name);
        return Response::json(["data" => $role]);
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
