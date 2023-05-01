<?php

namespace App\Http\Resources\Leaderboard;

use App\Http\Resources\Resource;

class LeaderboardResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'week_number' => $this->week_number,
            'weekend_date' => $this->weekend_date,
            'rank' => $this->rank,
            'last_week_rank' => $this->last_week_rank,
            'end_last_year_rank' => $this->end_last_year_rank,
            'is_tied' => $this->is_tied,
            'points_lost' => $this->points_lost,
            'points_won' => $this->points_won,
            'points_total' => $this->points_total,
            'points_average' => $this->points_average,
            'divisor_actual' => $this->divisor_actual,
            'divisor_applied' => $this->divisor_applied,
        ];
    }
}
