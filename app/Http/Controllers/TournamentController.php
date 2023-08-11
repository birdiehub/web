<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TournamentService;
use App\Http\Resources\Tours\Tournaments\TournamentCollection;
use App\Http\Resources\Tours\Tournaments\TournamentResource;

class TournamentController extends Controller
{
    private string $_class;
    private TournamentService $_service;

    public function __construct(TournamentService $service)
    {
        $this->_service = $service;
        $this->_class = $this->_service->model()::class;
    }

    public function all(Request $request, $tourId) {

        $year = $request->get("year", null);
        $tournaments = $this->_service->all($tourId);
        if ($year) {
            $tournaments = $tournaments->where('year', $year);
        }
        return new TournamentCollection($tournaments);
    }

    public function get(Request $request, $tourId, $tournamentId) {
        $tournament = $this->_service->get($tourId, $tournamentId);
        return new TournamentResource($tournament);
    }
}
