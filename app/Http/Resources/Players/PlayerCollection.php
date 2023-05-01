<?php

namespace App\Http\Resources\Players;

use App\Http\Resources\Countries\CountryCollection;
use App\Http\Resources\ResourceCollection;

class PlayerCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection->map(function ($player) {
            return [
                'id' => $player->id,
                'first_name' => $player->first_name,
                'last_name' => $player->last_name,
                'full_name' => $player->first_name . " " . $player->last_name,
                'headshot' => $player->headshot,
                'gender' => $this->translate($player, 'gender'),
                'country' => new CountryCollection($player->country)
            ];
        })->toArray();
    }
}

