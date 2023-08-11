<?php

namespace App\Http\Resources\Tours\Tournaments\Leaderboard;

use App\Http\Resources\ResourceCollection;

class TournamentLeaderboardCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return $this->collection->sortBy('rank')->toArray();
    }
}
