<?php

namespace App\Services\Countries;

use App\Models\Country;
use App\Services\Service;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CountryService extends Service
{
    protected array $_insertRules = [
        "code" => "required|string|min:2|max:2|unique:countries,code",
        "translations" => "required|array"
    ];

    protected array $_updateRules = [
        "id" => "prohibited",
        "code" => "string|min:2|max:2|unique:countries,code",
        "translations" => "array"
    ];

    protected array $_insertRulesTranslations = [
        "language" => "required|string|min:2|max:2",
        "name" => "required|string|min:2|max:255",
    ];

    protected array $_updateRulesTranslations = [
        "country_id" => "required|int|exists:countries,id",
        "language" => "required|string|min:2|max:2",
        "name" => "string|min:2|max:255",
    ];

    public function __construct(Country $model)
    {
        parent::__construct($model);
    }


    public function create($data) : Model
    {
        Validator::oneToMany($data, $this->_insertRules, $this->_insertRulesTranslations, "translations");
        $model = parent::create($data);
        $model->translations()->createMany($data["translations"]);
        return $model;
    }


    public function update($id, $data) : Model
    {
        Validator::oneToMany($data, $this->_updateRules, $this->_updateRulesTranslations, "translations");
        $model = parent::update($id, $data);
        if (isset($data["translations"]))
            $model->translations()->upsert($data["translations"], ["country_id", "language"]);
        return $model;
    }
}
