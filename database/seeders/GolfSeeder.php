<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\CountryLanguage;
use App\Models\FedExCup;
use App\Models\FedExCupStanding;
use App\Models\Player;
use App\Models\PlayerLanguage;
use App\Models\PlayerSnapshotLanguage;
use App\Models\PlayerSocial;
use App\Models\WorldGolfRanking;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class GolfSeeder extends Seeder
{


    public function run()
    {

        $wgr_list = $this->requestWGR()['rankingsList'];
        $pga_list = $this->requestPGA($this->playerDirectoryGraphQLQuery());

        for ($i = 0; $i < count($wgr_list); $i++) {

            $player = $wgr_list[$i]['player']; // Fundamental player data: firstname, lastname, etc
            $details = null; // Player details
            $snapshots = null; // Player snapshots
            $socials = null; // Player socials
            $fedex = null; // FedEx Cup points of the player
            $wgr = $wgr_list[$i]; // WGR of the player

            for ($j = 0; $j < count($pga_list['data']['playerDirectory']['players']); $j++) {

                $pga_player = $pga_list['data']['playerDirectory']['players'][$j];
                if ($player['firstName'] === $pga_player['firstName'] && $player['lastName'] === $pga_player['lastName']) {
                    $pga_data = $this->requestPGA($this->playerGraphQLQuery($pga_player['id']));
                    $pga_data = array_merge($pga_data['data']['player'], $pga_data['data']['playerProfileOverview']);

                    $details = $pga_data['playerBio'];
                    $details['headshot'] = $pga_data['headshot']['image'];

                    $snapshots = $pga_data['snapshot'];
                    $socials = $pga_data['playerBio']['social'];
                    $fedex = $pga_data['standings'];
                }
            }

            $playerId = $this->savePlayer($player, $details);
            $this->saveSocials($playerId, $socials);
            $this->saveSnapshots($playerId, $snapshots);
            $this->saveFedEx($playerId, $fedex);
            $this->saveWGR($playerId, $wgr);
        }
    }

    private function findCountry($code): int
    {

        switch ($code){
            case 'USA':
                $code = 'US';
                break;
            case 'England' || 'Scotland' || 'Wales' || 'Northern-Ireland':
                $code = 'GB';
                break;
            case 'Norway':
                $code = 'NO';
                break;
            default:
                print 'Country not found: ' . $code . PHP_EOL;
                break;
        }

        return Country::where('code', $code)->first()->id;
    }

    private function savePlayer($player, $details): int
    {
        $model = new Player();
        $model_lang = new PlayerLanguage();

        $model->first_name = $player['firstName'];
        $model->last_name = $player['lastName'];
        $model->full_name = $player['fullName'];
        $model->birth_date = $player['birthDate'];
        $model_lang->gender = $player['gender'];
        $model->is_amateur = $player['isAmateur'];

        if (!is_null($details)) {
            $model->headshot = $details['headshot'];
            $model->turned_pro = $details['turnedPro'];
            $model_lang->family = $details['family'];
            $model->weight_kilograms = $details['weightKilograms'];
            $model->weight_imperial = $details['weightImperial'];
            $model->height_meters = $details['heightMeters'];
            $model->height_imperial = $details['heightImperial'];
            $model_lang->degree = $details['degree'];
            $model->college = $details['school'];
            $model->graduation_year = $details['graduationYear'];
            $model->career_earnings = $details['careerEarnings'];

            $model->country_id = $this->findCountry($details['birthplace']['countryCode']);

            // bio
            if ($details['personal'] != null) {
                $model_lang->bio = implode("\n", $details['personal']);
            }
        }

        $other = Player::where('first_name', $model->first_name)
            ->where('last_name', $model->last_name)
            ->first();

        if ($other) {
            $other->update($model->AttributesToArray());
            $id = $other->id;
            $other_lang = PlayerLanguage::where("player_id", $id)
                    ->where("language", 'en');
            $other_lang ->update($model_lang->AttributesToArray());
            return $id;
        } else {
            $model->save();
            $model_lang->player_id = $model->id;
            $model_lang->language = 'en';
            $model_lang->save();
            return $model->id;
        }
    }

    private function saveSocials($playerId, $socials): void {

        // save or update socials
        foreach ($socials ?? [] as $social){
            $model = new PlayerSocial();
            $model->player_id = $playerId;
            $model->channel = $social['type'];
            $model->url = $social['url'];

            $other = PlayerSocial::where('player_id', $model->player_id)
                ->where('channel', $model->channel)
                ->first();

            if ($other) {
                $other->update($model->AttributesToArray());
            } else {
                $model->save();
            }
        }
    }

    private function saveSnapshots($playerId, $snapshots): void {

        // save or update socials
        foreach ($snapshots ?? [] as $snapshot){
            $model = new PlayerSnapshotLanguage();
            $model->player_id = $playerId;
            $model->language = 'en';
            $model->title = $snapshot['title'];
            $model->value = $snapshot['value'];
            $model->description = $snapshot['description'];

            $other = PlayerSnapshotLanguage::where('player_id', $model->player_id)
                ->where('language', 'en')
                ->where('title', $model->title)
                ->first();

            if ($other) {
                $other->update($model->AttributesToArray());
            } else {
                $model->save();
            }
        }
    }

    private function saveFedEx($playerId, $fedex): void {

        $cup = new FedExCup();
        $cup->id = $fedex['id'];
        $cup->title = str_replace('-', ' ', substr($fedex['id'], 1));
        $cup->season = preg_match('/\d+$/', $fedex['id'], $matches) ? $matches[0] : null;

        $other = FedExCup::where('id', $cup->id)->first();

        if ($other) {
            $other->update($cup->AttributesToArray());
        } else {
            $cup->save();
        }

        $standing = new FedExCupStanding();
        $standing->player_id = $playerId;
        $standing->fed_ex_cup_id = $fedex['id'];
        $standing->points = (int) str_replace(',', '', $fedex['total']);
        $standing->rank = (int) $fedex['rank'];

        $other = FedExCupStanding::where('player_id', $standing->player_id)
            ->where('fed_ex_cup_id', $standing->fed_ex_cup_id)
            ->first();

        if ($other) {
            $other->update($standing->AttributesToArray());
        } else {
            $standing->save();
        }
    }

    private function saveWGR($playerId, $wgr): void {

        $model = new WorldGolfRanking();
        $model->player_id = $playerId;
        $model->week_number = $wgr['weekNumber'];
        $model->weekend_date = $wgr['weekEndDate'];
        $model->rank = $wgr['rank'];
        $model->is_tied = $wgr['isTied'];
        $model->points_lost = $wgr['pointsLost'];
        $model->points_won = $wgr['pointsWon'];
        $model->points_total = $wgr['pointsTotal'];
        $model->points_average = $wgr['pointsAverage'];
        $model->divisor_actual = $wgr['divisorActual'];
        $model->divisor_applied = $wgr['divisorApplied'];
        $model->last_week_rank = $wgr['lastWeekRank'];
        $model->end_last_year_rank = $wgr['endLastYearRank'];


        $other = WorldGolfRanking::where('player_id', $model->player_id)
            ->where('week_number', $model->week_number)
            ->first();

        if (!$other) {
            $model->save();
        }
    }


    private function playerDirectoryGraphQLQuery($tourCode = 'R'): array
    {
        return [
            'variables'=> [
                'tourCode' => $tourCode
            ],
            'query' => config('data_sources.pga.queries.players')
        ];
    }

    private function playerGraphQLQuery($playerId, $tourCode = 'R'): array
    {
        return [
            'variables' => [
                'currentTour' => $tourCode,
                'playerId' => $playerId
            ],
            'query' => config('data_sources.pga.queries.player')
        ];
    }

    private function requestWGR()
    {
        // Download the JSON file from the URL
        // The timeout is set to 10 minutes because the file is large
        $response = Http::withOptions(['timeout' => 600, 'connect_timeout' => 30])->get(config('data_sources.wgr.url'));
        return json_decode($response->body(), true);
    }

    private function requestPGA($body)
    {
        $response = Http::withHeaders(config('data_sources.pga.header'))->post(config('data_sources.pga.url'), $body);

        return json_decode($response->body(), true);
    }

}
