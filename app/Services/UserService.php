<?php

namespace App\Services;

use App\Models\User;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserService extends Service
{
    protected array $_updateRules = [
        "id"=> "prohibited",
        'username' => 'string|max:255||unique:users,username',
        'password' => 'string|max:255|min:8',
        "first_name" => "string",
        "last_name" => "string",
        "email" => "email|max:255",
        "phone" => "string",
        "address" => "string",
        "city" => "string",
        "zip" => "string",
        "country_id" => "int|exists:countries,id"
    ];

    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function update($id, $data) : Model {

        Validator::standalone($data, $this->_updateRules);

        if (isset($data['password']))
            $data['password'] = Hash::make($data['password']);

        return parent::update($id, $data);
    }

}
