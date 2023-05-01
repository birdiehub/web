<?php

namespace App\Http\Controllers;

use App\Http\Resources\Players\PlayerCollection;
use App\Http\Resources\Players\PlayerResource;
use App\Http\Response;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PlayerController extends Controller
{

    private string $_class;
    private PlayerService $_service;

    public function __construct(PlayerService $service)
    {
        $this->_service = $service;
        $this->_class = $this->_service->model()::class;
    }

    public function all(Request $request): PlayerCollection
    {
        $this->authorize('viewPlayers', $this->_class);

        $pages = $request->get("pages", 10);
        $players = $this->_service->model();
        return new PlayerCollection($players::paginate($pages));
    }


    public function create(Request $request): PlayerResource
    {
        $this->authorize('createPlayer', $this->_class);

        $data = $request->all();
        $player = $this->_service->create($data);
        return new PlayerResource($player);
    }

    public function get(Request $request, $id): PlayerResource
    {
        $this->authorize('viewPlayer', $this->_class);

        $player = $this->_service->find($id);
        return new PlayerResource($player);
    }

    public function update(Request $request, $id): PlayerResource
    {
        $this->authorize('editPlayer', $this->_class);

        $data = $request->all();
        $player = $this->_service->update($id, $data);
        return new PlayerResource($player);
    }

    public function delete($id): JsonResponse
    {
        $this->authorize('deletePlayer', $this->_class);

        $this->_service->delete($id);
        return Response::ok();
    }

}
