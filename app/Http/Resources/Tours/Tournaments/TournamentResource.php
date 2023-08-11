<?php

namespace App\Http\Resources\Tours\Tournaments;

use App\Http\Resources\Tours\TourResource;
use App\Http\Resources\Tours\Courses\CourseResource;
use App\Http\Resources\Tours\Tournaments\Leaderboard\TournamentLeaderboardCollection;


use App\Http\Resources\Resource;

class TournamentResource extends Resource
{
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'tour' => new TourResource($this->tour),
          'name' => $this->name,
          'year' => $this->year,
          'course' => new CourseResource($this->course),
          'start_date' => $this->start_date,
          'end_date' => $this->end_date,
          'leaderboard' => new TournamentLeaderboardCollection($this->leaderboard),
        ];
    }
}
