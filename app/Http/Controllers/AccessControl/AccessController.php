<?php

namespace App\Http\Controllers\AccessControl;

use App\Http\Controllers\Controller;
use App\Http\Response;
use App\Services\AccessControl\AccessService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccessController extends Controller
{
    private AccessService $_service;
    public function __construct(AccessService $service)
    {
        $this->_service = $service;
    }

    public function list($userId): JsonResponse
    {
        $roles = $this->_service->roles($userId);
        $permissions = $this->_service->permissions($userId);
        return Response::json(["data" => [
            "roles" => $roles,
            "permissions" => $permissions
        ]]);
    }

    public function grantPermission(Request $request, $userId, $name): JsonResponse
    {
        $this->_service->grantPermission($userId, $name);
        return Response::ok();
    }

    public function revokePermission(Request $request, $userId, $name): JsonResponse
    {
        $this->_service->revokePermission($userId, $name);
        return Response::ok();
    }

    public function grantRole(Request $request, $userId, $name): JsonResponse
    {
        $this->_service->grantRole($userId, $name);
        return Response::ok();
    }

    public function revokeRole(Request $request, $userId, $name): JsonResponse
    {
        $this->_service->revokeRole($userId, $name);
        return Response::ok();
    }

}
