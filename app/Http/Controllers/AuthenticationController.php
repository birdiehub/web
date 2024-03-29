<?php

namespace App\Http\Controllers;

use App\Http\Resources\Users\UserResource;
use App\Http\Response;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{

    private AuthService $_service;
    public function __construct(AuthService $service)
    {
        $this->_service = $service;
    }
    public function register(Request $request): JsonResponse
    {
        $data = $request->all();
        $token = $this->_service->register($data);

        return Response::json(["token" => $token], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $data = $request->all();
        $token = $this->_service->login($data);

        return Response::json(["token" => $token]);
    }

    public function logout(): JsonResponse
    {
        $this->_service->logout();
        return Response::ok();
    }

    public function refresh(): JsonResponse
    {
        $token = $this->_service->refresh();
        return Response::json(["token" => $token]);
    }

    public function isAuthenticated(): JsonResponse
    {
        return Response::ok();
    }

    public function me(Request $request): UserResource
    {
        $user = $this->_service->me();
        $this->authorize('viewOwnUser', $user);
        return new UserResource($user);
    }
}
