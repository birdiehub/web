<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Controller;
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

    public function all() : JsonResponse
    {
        $permissions = $this->_service->all();
        return Response::json(["data" => $permissions]);
    }

    public function list() : JsonResponse
    {
        $permissions = $this->_service->list();
        return Response::json(["data" => $permissions]);
    }

    public function create(Request $request) : JsonResponse
    {
        $permission = $this->_service->create($request->all());
        return Response::json(["data" => $permission]);
    }

    public function get($name) : JsonResponse
    {
        $permission = $this->_service->get($name);
        return Response::json(["data" => $permission]);
    }

    public function delete($name) : JsonResponse
    {
        $this->_service->delete($name);
        return Response::ok();
    }
}
