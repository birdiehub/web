<?php

namespace App\Http\Resources\Players;

use App\Http\Resources\Countries\CountryResource;
use App\Http\Resources\Leaderboard\LeaderboardResource;
use App\Http\Resources\Players\Snapshots\SnapshotCollection;
use App\Http\Resources\Players\Socials\SocialCollection;
use App\Http\Resources\Resource;

class PlayerResource extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'full_name'  => $this->full_name,
            'headshot'   => $this->headshot,
            'is_amateur' => $this->is_amateur,
            'birth_date' => $this->birth_date,
            'turned_pro' => $this->turned_pro,
            'college'    => $this->college,
            'graduation_year' => $this->graduation_year,
            'career_earnings' => $this->career_earnings,
            'height_imperial' => $this->height_imperial,
            'height_meters'   => $this->height_meters,
            'weight_imperial' => $this->weight_imperial,
            'weight_kilograms' => $this->weight_kilograms,
            'gender' => $this->translate('gender'),
            'bio' => $this->translate('bio'),
            'degree' => $this->translate('degree'),
            'family' => $this->translate('family'),
            'country' => new CountryResource($this->country),
            'socials' => new SocialCollection($this->socials),
            'snapshots' => new SnapshotCollection($this->snapshots),
            'current_rank' => new LeaderboardResource($this->currentRank())
        ];
    }
}
