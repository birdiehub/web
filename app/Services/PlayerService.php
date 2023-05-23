<?php

namespace App\Services;

use App\Models\Player;
use App\Validators\Validator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlayerService extends Service
{

    protected array $_baseRules = [
        'id' => ['prohibited'],
        'full_name' => ['string'],
        'headshot' => ['string'],
        'is_amateur' => ['boolean'],
        'birth_date' => ['date'],
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

    private static string $LATEST_WEEKEND_SQ = "(SELECT leaderboards.player_id, MAX(leaderboards.weekend_date) as max_weekend_date FROM leaderboards GROUP BY leaderboards.player_id) as lb";
    private static  string $RANK_SQ = '(SELECT leaderboards.rank FROM leaderboards WHERE leaderboards.weekend_date = lb.max_weekend_date AND leaderboards.player_id = players.id) as `rank`';

    public function __construct(Player $model)
    {
        parent::__construct($model);
    }

    public function getPlayersWithRank()
    {
        // Code that give me a headache:
        // Note: this query is not very efficient, but it's the only way I found to get the rank of a player and be able to sort by it
        return Player::leftJoin(DB::raw(self::$LATEST_WEEKEND_SQ), function($join) {
            $join->on('players.id', '=', 'lb.player_id');
        })
            ->select('players.*', DB::raw(self::$RANK_SQ));
    }

    public function create($data): Model
    {
        Validator::standalone($data, array_merge($this->_baseRules,  [
            'first_name' => ['required', 'string'], // first_name and last_name should be unique together
            'last_name' => ['required', 'string'], // first_name and last_name should be unique together
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

    public function addSnapshot($id, $data): Model
    {
        Validator::standalone($data, [
            'id' => ['prohibited'],
            'title' => ['required', 'array'],
            'value' => ['array'],
            'description' => ['array'],
        ]);
        $player = $this->find($id);
        $player->snapshots()->create($data);
        return $player;
    }

    public function deleteSnapshot($playerId, $snapshotId): bool
    {
        $player = $this->find($playerId);
        return $player->snapshots()->findOrFail($snapshotId)->delete();
    }

}
