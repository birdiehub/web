<?php

namespace App\Modules\Countries\Services;

use App\Models\Country;
use App\Modules\Core\Services\TranslationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CountryService extends TranslationService
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

    public function all(): Builder
    {
        return $this->_model
            ->with("translations");
    }


    public function list($language): Builder
    {
        return $this->_model
            ->with(
                ["translations" => function ($query) use ($language) {
                    return $query->where("language", $language);
                }]
            );
    }


    public function create($country) : Model
    {
        $this->validate($country, $this->_insertRules, $this->_insertRulesTranslations);
        $model = $this->_model->create($country);
        $model->translations()->createMany($country["translations"]);
        return $this->get($model->id);
    }


    public function get($id): Model
    {
        $data = $this->_model
            ->with("translations")
            ->find($id);

        if(!$data)
            throw new ModelNotFoundException("Unable to find country with id: $id");

        return $data;
    }


    public function update($id, $country) : Model
    {
        $this->validate($country, $this->_updateRules, $this->_updateRulesTranslations);
        $model = $this->get($id);
        $model->update($country);
        if (isset($country["translations"]))
            $model->translations()->upsert($country["translations"], ["country_id", "language"]);
        return $this->get($model->id);
    }


    public function delete($id) : bool
    {
        $model = $this->get($id);
        return $model->delete();
    }
}
