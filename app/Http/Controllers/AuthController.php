<?php

namespace App\Http\Controllers;

use App\Http\Response;
use App\Modules\Users\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $_service;
    public function __construct(AuthService $service)
    {
        $this->_service = $service;
    }
    public function register(Request $request) {
        $data = $request->all();
        $token = $this->_service->register($data);

        return Response::json(["token" => $token], 201);
    }

    public function login(Request $request) {
        $data = $request->all();
        $token = $this->_service->login($data);

        return Response::json(["token" => $token]);
    }
}
