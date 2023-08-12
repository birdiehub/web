<?php

namespace App\Services;

use App\Models\Country;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;

class CountryService extends Service
{
    protected array $_insertRules = [
        "code" => "required|string|min:2|max:2|unique:countries,code",
        "name" => "required|array"
    ];

    protected array $_updateRules = [
        "id" => "prohibited",
        "code" => "string|min:2|max:2|unique:countries,code",
        "name" => "array",
    ];

    public function __construct(Country $model)
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
