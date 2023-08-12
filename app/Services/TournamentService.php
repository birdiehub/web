<?php

namespace App\Services;

use App\Models\Tournament;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TournamentService extends Service
{

    public function __construct(Tournament $model)
    {
        parent::__construct($model);
    }


    public function all($tourId)
    {
        return $this->model()::where('tour_id', $tourId)->get();
    }

    public function get($tourId, $tournamentId)
    {
        return $this->model()::where('tour_id', $tourId)->where('id', $tournamentId)->first();
    }
}
