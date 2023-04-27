<?php

namespace App\Http\Controllers;

use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ValidatorException;
use App\Http\Response;
use App\Modules\Users\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserApiController extends Controller
{
    private UserService $_service;
    public function __construct(UserService $service)
    {
        $this->_service = $service;
    }

    public function all(Request $request): JsonResponse
    {
        $pages = $request->get("pages", 10);
        $users = $this->_service->all()->paginate($pages)->withQueryString();

        return Response::json($users);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function get($id): JsonResponse
    {
        $user = $this->_service->get($id);
        return Response::json(["data" => $user]);
    }

    /**
     * @throws ValidatorException
     * @throws ResourceNotFoundException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $data = $request->all();
        $user = $this->_service->update($id, $data);
        return Response::json(["data" => $user]);
    }

    /**
     * @throws ResourceNotFoundException
     */
    public function delete($id): JsonResponse
    {
        $this->_service->delete($id);
        return Response::ok();
    }

}
