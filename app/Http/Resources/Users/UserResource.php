<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Countries\CountryResource;
use App\Http\Resources\Resource;

class UserResource extends Resource
{

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->first_name . " " . $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'zip' => $this->zip,
            'country' => new CountryResource($this->country, $this->_language)
        ];
    }

}
