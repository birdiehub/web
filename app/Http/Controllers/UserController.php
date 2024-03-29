<?php

namespace App\Http\Controllers;

use App\Http\Resources\Users\UserCollection;
use App\Http\Resources\Users\UserResource;
use App\Http\Response;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Controller responsibilities authorization and presentation

class UserController extends Controller
{

    private string $_class;
    private UserService $_service;
    public function __construct(UserService $service)
    {
        $this->_service = $service;
        $this->_class = $this->_service->model()::class;
    }

    public function all(Request $request): UserCollection
    {
        $this->authorize('viewUsers', $this->_class);

        $pages = $request->get("pages", 10);
        $users = $this->_service->model();
        return new UserCollection($users::paginate($pages));
    }

    public function create(Request $request): UserResource
    {
        $this->authorize('createUser', $this->_class);

        $data = $request->all();
        $user = $this->_service->create($data);
        return new UserResource($user);
    }

    public function get(Request $request, $id): UserResource
    {
        $this->authorize('viewUser', $this->_service->find($id));

        $user = $this->_service->find($id);
        return new UserResource($user);
    }

    public function update(Request $request, $id): UserResource
    {
        $this->authorize('editUser', $this->_service->find($id));

        $data = $request->all();
        $user = $this->_service->update($id, $data);
        return new UserResource($user);
    }

    public function delete($id): JsonResponse
    {
        $this->authorize('deleteUser', $this->_service->find($id));

        $this->_service->delete($id);
        return Response::ok();
    }

}
