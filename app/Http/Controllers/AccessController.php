<?php

namespace App\Http\Controllers;

use App\Http\Response;
use App\Services\AccessService;
use Illuminate\Http\JsonResponse;

class AccessController extends Controller
{

    private string $_class;
    private AccessService $_service;
    public function __construct(AccessService $service)
    {
        $this->_service = $service;
        $this->_class = $this->_service->model()::class;
    }

    public function list($userId): JsonResponse
    {
        $this->authorize("viewUserAccess", $this->_class);

        $user = $this->_service->find($userId);
        return Response::json(["data" => [
            "roles" => $user->getRoleNames(),
            "permissions" => $user->getPermissionNames()
        ]]);
    }

    public function grantPermission($userId, $name): JsonResponse
    {
        $this->authorize("grantUserPermission", [$this->_class, $name]);

        $this->_service->grantPermission($userId, $name);
        return Response::ok();
    }

    public function revokePermission($userId, $name): JsonResponse
    {
        $this->authorize("revokeUserPermission", [$this->_class, $name]);

        $this->_service->revokePermission($userId, $name);
        return Response::ok();
    }

    public function grantRole($userId, $name): JsonResponse
    {
        $this->authorize("grantUserRole", [$this->_class, $name]);

        $this->_service->grantRole($userId, $name);
        return Response::ok();
    }

    public function revokeRole($userId, $name): JsonResponse
    {
        $this->authorize("revokeUserRole", [$this->_class, $name]);

        $this->_service->revokeRole($userId, $name);
        return Response::ok();
    }

}
