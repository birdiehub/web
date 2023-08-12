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

    public function all(Request $request)
    {
        // $this->authorize('viewPlayers', $this->_class);

        $pages = $request->get("pages", 10);
        $sort = $request->get("sort", "id,asc");
        $sort = explode(",", $sort);
        $sort[0] = in_array($sort[0], ["id", "first_name", "last_name", "rank"]) ? $sort[0] : "id";
        $players = $this->_service->getPlayersWithRank()->orderBy($sort[0], $sort[1] ?? "asc");
        return new PlayerCollection($players->paginate($pages));
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

    public function addSocial(Request $request, $id): PlayerResource
    {
        $this->authorize('editPlayer', $this->_class);

        $data = $request->all();
        $player = $this->_service->addSocial($id, $data);
        return new PlayerResource($player);
    }

    public function deleteSocial($playerId, $socialId): JsonResponse
    {
        $this->authorize('editPlayer', $this->_class);

        $this->_service->deleteSocial($playerId, $socialId);
        return Response::ok();
    }

    public function addSnapshot(Request $request, $id): PlayerResource
    {
        $this->authorize('editPlayer', $this->_class);

        $data = $request->all();
        $player = $this->_service->addSnapshot($id, $data);
        return new PlayerResource($player);
    }

    public function deleteSnapshot($playerId, $snapshotId): JsonResponse
    {
        $this->authorize('editPlayer', $this->_class);

        $this->_service->deleteSnapshot($playerId, $snapshotId);
        return Response::ok();
    }

}
