<?php

namespace App\Http\Resources\Tours\Tournaments\Leaderboard;

use App\Http\Resources\Resource;

class TournamentLeaderboardResource extends Resource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'player' => [
                'id' => $this->player->id,
                'first_name' => $this->player->first_name,
                'last_name'  => $this->player->last_name,
                'full_name'  => $this->player->full_name,
                'headshot'   => $this->player->headshot,
            ],
            'rank' => $this->rank,
            'points_total' => $this->points_total
        ];
    }
}
