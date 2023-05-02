<?php

namespace App\Services;

use App\Models\User;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;

// User responsible for handling all the business logic

class UserService extends Service
{
    protected array $_insertRules = [
        "id"=> "prohibited",
        'username' => 'required|string|max:255|min:4|unique:users,username',
        'password' => 'required|string|max:255|min:8',
        "first_name" => "required|string",
        "last_name" => "required|string",
        "email" => "required|email|max:255",
        "phone" => "required|string",
        "address" => "required|string",
        "city" => "required|string",
        "zip" => "required|string",
        "country_id" => "required|int|exists:countries,id"
    ];

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

    public function create($data) : Model
    {
        Validator::standalone($data, $this->_insertRules);
        return parent::create($data);
    }

    public function update($id, $data) : Model
    {
        Validator::standalone($data, $this->_updateRules);
        return parent::update($id, $data);
    }

}
