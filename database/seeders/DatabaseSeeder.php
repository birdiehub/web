<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\PlayerSnapshot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // Official OWGR API URL
    private string $wgrUrl = 'https://apiweb.owgr.com/api/owgr/rankings/getRankings?pageSize=300&pageNumber=1&regionId=0&countryId=0&sortString=pointsTotal+DESC';

    // Official PGA Tour API URL
    private string $pgaUrl = 'https://orchestrator.pgatour.com/graphql';

    public function run()
    {
        $players = $this->aggregatePlayers();
        print count($players) . " players found\n";

        foreach ($players as $player) {

            // TODO: Add logic to save player to database

        }

    }

    private function aggregatePlayers() : array
    {
        $result = [];

        $wgr = $this->requestWGR();
        $players = $this->requestPGA($this->playerDirectoryGraphQLQuery());


        for ($i = 0; $i < count($wgr['rankingsList']); $i++) {
            $wgrRank = null;
            $wgrRank = $wgr['rankingsList'][$i];

            $player = $this->playerDictionaryTemplate(); // reset variable
            $player['birthDate'] = $wgrRank['player']['birthDate'];
            $player['firstName'] = $wgrRank['player']['firstName'];
            $player['lastName'] = $wgrRank['player']['lastName'];
            $player['fullName'] = $wgrRank['player']['fullName'];
            $player['gender'] = $wgrRank['player']['gender'];
            $player['isAmateur'] = $wgrRank['player']['isAmateur'];

            for ($j = 0; $j < count($players['data']['playerDirectory']['players']); $j++) {
                $pgaRank = $players['data']['playerDirectory']['players'][$j];

                if ($wgrRank['player']['firstName'] === $pgaRank['firstName'] && $wgrRank['player']['lastName'] === $pgaRank['lastName']) {
                    $pgaPlayer = $this->requestPGA($this->playerGraphQLQuery($pgaRank['id']));
                    $pgaPlayer = array_merge($pgaPlayer['data']['player'], $pgaPlayer['data']['playerProfileOverview']);

                    $player['bioLink'] = $pgaPlayer['bioLink'];

                    $playerBio = $pgaPlayer['playerBio'];
                    $player = array_merge($player, $playerBio);

                    if ($player['personal'] != null) {
                        $player['bio'] = implode("\n", $player['personal']);
                    }
                    unset($player['personal']);

                    $player['headshot'] = $pgaPlayer['headshot']['image'];
                    $player['snapshot'] = $pgaPlayer['snapshot'];
                    $player['fedExCup'] = $pgaPlayer['standings'];

                    break;
                }
            }
            unset($wgrRank['player']);
            unset($wgrRank['id']);
            $player['worldGolfRanking'] = $wgrRank;

            $result[] = $player;
        }
        return $result;
    }

    private function playerDictionaryTemplate(): array
    {
        return [
            "bioLink" => null,
            "firstName" => null,
            "lastName" => null,
            "fullName" => null,
            "birthDate" => null,
            "gender" => null,
            "isAmateur" => null,
            "turnedPro" => null,
            "websiteURL" => null,
            "degree" => null,
            "careerEarnings" => null,
            "family" => null,
            "school" => null,
            "graduationYear" => null,
            "heightImperial" => null,
            "heightMeters" => null,
            "weightImperial" => null,
            "weightKilograms" => null,
            "overview" => null,
            "bio" => null,
            "pronunciation" => null,
            "birthplace" => [
                "countryCode" => null,
                "country" => null,
                "city" => null,
                "state" => null,
                "stateCode" => null
            ],
            "residence" => [
                "city" => null,
                "country" => null,
                "state" => null,
                "countryCode" => null,
                "stateCode" => null
            ],
            "social" => array(
                [
                    "type" => null,
                    "url" => null
                ]
            ),
            "headshot" => null,
            "snapshot" => null,
            "fedExCup" => null,
            "worldGolfRanking" => [
                "rank" => null,
                "isTied" => null,
                "pointsLost" => null,
                "pointsWon" => null,
                "pointsTotal" => null,
                "pointsAverage" => null,
                "divisorActual" => null,
                "divisorApplied" => null,
                "endLastYearRank" => null,
                "lastWeekRank" => null,
                "weekNumber" => null,
                "weekEndDate" => null
            ]
        ];

    }

    private function playerDirectoryGraphQLQuery($tourCode = 'R'): array
    {
        return [
            'operationName'=> 'PlayerDirectory',
            'variables'=> [
                'tourCode' => $tourCode
            ],
            'query' => 'query PlayerDirectory($tourCode: TourCode!, $active: Boolean) {
                            playerDirectory(tourCode: $tourCode, active: $active) {
                                tourCode
                                players {
                                    id
                                    isActive
                                    firstName
                                    lastName
                                    shortName
                                    displayName
                                    alphaSort
                                    country
                                    countryFlag
                                    headshot
                                    playerBio {
                                        id
                                        age
                                        education
                                        turnedPro
                                    }
                                }
                            }
                        }'
        ];
    }

    private function playerGraphQLQuery($playerId, $tourCode = 'R'): array
    {
        return [
            'variables' => [
                'currentTour' => $tourCode,
                'playerId' => $playerId
            ],
            'query' => 'query Player($playerId: ID!, $currentTour: TourCode) {
                            playerProfileOverview(playerId: $playerId, currentTour: $currentTour) {
                                headshot {
                                    image
                                }
                                standings {
                                    id
                                    logo
                                    logoDark
                                    title
                                    description
                                    total
                                    totalLabel
                                    rank
                                    rankLogo
                                    rankLogoDark
                                    webview
                                    webviewBrowserControls
                                }
                                snapshot {
                                    title
                                    value
                                    description
                                }
                            }
                            player(id: $playerId) {
                                bioLink
                                firstName
                                id
                                lastName
                                playerBio {
                                    birthplace {
                                        countryCode
                                        country
                                        city
                                        state
                                        stateCode
                                    }
                                    degree
                                    careerEarnings
                                    family
                                    graduationYear
                                    heightImperial
                                    heightMeters
                                    overview
                                    personal
                                    pronunciation
                                    residence {
                                        city
                                        country
                                        state
                                        countryCode
                                        stateCode
                                    }
                                    school
                                    social {
                                        type
                                        url
                                    }
                                    turnedPro
                                    weightImperial
                                    weightKilograms
                                    websiteURL
                                }
                            }
                        }'
        ];
    }

    private function requestWGR()
    {
        // Download the JSON file from the URL
        // The timeout is set to 10 minutes because the file is large
        $response = Http::withOptions(['timeout' => 600, 'connect_timeout' => 30])->get($this->wgrUrl);
        return json_decode($response->body(), true);
    }

    private function requestPGA($body)
    {
        $response = Http::withHeaders([
            'Origin' => 'https://www.pgatour.com',
            'Referer' => 'https://www.pgatour.com',
            'Content-Type' => 'application/json',
            'x-amz-user-agent' => 'aws-amplify/3.0.7',
            'x-api-key' => 'da2-gsrx5bibzbb4njvhl7t37wqyl4',
            'x-pgat-platform' => 'web'
        ])->post($this->pgaUrl, $body);

        return json_decode($response->body(), true);
    }

}
