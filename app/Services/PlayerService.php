<?php

namespace App\Services;

use App\Models\Player;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class PlayerService extends Service
{

    protected array $_baseRules = [
        'id' => ['prohibited'],
        'full_name' => ['string'],
        'headshot' => ['string'],
        'is_amateur' => ['boolean'],
        'birth_date' => ['datetime'],
        'turned_pro' => ['integer'],
        'college' => ['string'],
        'graduation_year' => ['integer'],
        'career_earnings' => ['integer'],
        'height_imperial' => ['string'],
        'height_meters' => ['string'],
        'weight_imperial' => ['string'],
        'weight_kilograms' => ['string'],
        'bio' => ['array'],
        'degree' => ['array'],
        'family' => ['array'],
        'socials' => ['prohibited'],
        'snapshots' => ['prohibited']
    ];

    public function __construct(Player $model)
    {
        parent::__construct($model);
    }

    public function create($data): Model
    {
        Validator::standalone($data, array_merge($this->_baseRules,  [
            'first_name' => ['required', 'string', Rule::unique('players','first_name')->where('last_name',$data['last_name'])], // first_name and last_name are unique together
            'last_name' => ['required', 'string', Rule::unique('players','last_name')->where('first_name',$data['first_name'])], // first_name and last_name are unique together
            'gender' => ['required', 'array'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
        ]));
        return parent::create($data);
    }

    public function update($id, $data): Model
    {
        // Note: impossible to check if first_name and last_name are unique together
        // If they are not unique together, a QueryException will be thrown (= 500 server error)
        Validator::standalone($data, array_merge($this->_baseRules,  [
            'first_name' => ['string'],
            'last_name' => ['string'],
            'gender' => ['array'],
            'country_id' => ['integer', 'exists:countries,id'],
        ]));
        return parent::update($id, $data);
    }

    public function addSocial($id, $data): Model
    {
        Validator::standalone($data, [
            'id' => ['prohibited'],
            'channel' => ['required', 'string'],
            'url' => ['required', 'string'],
        ]);
        $player = $this->find($id);
        $player->socials()->create($data);
        return $player;
    }

    public function deleteSocial($playerId, $socialId): bool
    {
        $player = $this->find($playerId);
        return $player->socials()->findOrFail($socialId)->delete();
    }

}
