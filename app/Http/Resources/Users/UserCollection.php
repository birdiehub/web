<?php

namespace App\Http\Resources\Users;


use App\Http\Resources\ResourceCollection;

class UserCollection extends ResourceCollection
{

    public function toArray($request) : array
    {
        return $this->collection->map(function ($user) {
            return [
                'id' => $user->id,
                'username' => $user->username,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'full_name' => $user->first_name . " " . $user->last_name
            ];
        })->toArray();
    }
}
