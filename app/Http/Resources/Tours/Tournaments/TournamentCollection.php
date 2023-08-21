<?php

namespace App\Http\Resources\Tours\Tournaments;

use App\Http\Resources\ResourceCollection;
use App\Http\Resources\Tours\TourResource;
use App\Http\Resources\Tours\Courses\CourseResource;

class TournamentCollection extends ResourceCollection
{

    public function toArray($request)
    {
        return $this->collection->map(function ($tournament) {
            return [
                'id' => $tournament->id,
                'tour' => new TourResource($tournament->tour),
                'name' => $tournament->name,
                'year' => $tournament->year,
                'course' => new CourseResource($tournament->course),
                'start_date' => $tournament->start_date,
                'end_date' => $tournament->end_date,
            ];
        })->toArray();
    }
}
