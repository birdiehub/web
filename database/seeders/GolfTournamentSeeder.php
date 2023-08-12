<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Tour;
use App\Models\Tournament;
use App\Models\TournamentLeaderboard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Factories\Factory;

class GolfTournamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tour::destroy(Tour::all());
        Course::destroy(Course::all());

        Tour::firstOrCreate([
            'name' => 'PGA'
        ]);

        Tour::firstOrCreate([
            'name' => 'LIV'
        ]);

        Course::factory()->count(100)->create();

        // PGA Tour
        $this->generateTournament([2019, 2020, 2021, 2022, 2023], 'PGA', $this->pgaTournaments());

        // LIV Tour
        $this->generateTournament([2022, 2023], 'LIV', $this->livTournaments());

    }

    public function pgaTournaments() {
        return [
            'Sentry Tournament of Champions',
            'Sony Open in Hawaii',
            'The American Express',
            'Farmers Insurance Open',
            'AT&T Pebble Beach Pro-Am',
            'WM Phoenix Open',
            'The Genesis Invitational',
            'The Honda Classic',
            'Puerto Rico Open',
            'Arnold Palmer Invitational presented by Mastercard',
            'THE PLAYERS Championship',
            'Valspar Championship',
            'Corales Puntacana Championship',
            'World Golf Championships-Dell Technologies Match Play',
            'Valero Texas Open',
            'Masters Tournament',
            'RBC Heritage',
            'Zurich Classic of New Orleans',
            'Mexico Open at Vidanta',
            'Wells Fargo Championship',
            'AT&T Byron Nelson',
            'PGA Championship',
            'Charles Schwab Challenge',
            'the Memorial Tournament presented by Workday',
            'RBC Canadian Open',
            'U.S. Open',
            'Travelers Championship',
            'Rocket Mortgage Classic',
            'John Deere Classic',
            'Barbasol Championship',
            'Genesis Scottish Open',
            'Barracuda Championship',
            'The Open Championship',
            '3M Open',
            'Wyndham Championship',
            'FedEx St. Jude Championship',
            'BMW Championship',
            'TOUR Championship',
            'Fortinet Championship',
            'Presidents Cup',
            'Sanderson Farms Championship',
            'Shriners Children\'s Open',
            'ZOZO CHAMPIONSHIP',
            'THE CJ CUP in South Carolina',
            'Butterfield Bermuda Championship',
            'World Wide Technology Championship',
            'Cadence Bank Houston Open',
            'The RSM Classic',
            'Hero World Challenge',
            'QBE Shootout'
        ];
    }

    public function livTournaments() {
        return [
            'Abu Dhabi HSBC Championship',
            'Omega Dubai Desert Classic',
            'Saudi International powered by SoftBank Investment Advisers',
            'Omega Dubai Moonlight Classic',
            'ISPS HANDA World Invitational presented by Modest',
            'Aberdeen Standard Investments Scottish Open',
            'Cazoo Open supported by Gareth Bale',
            'Cazoo Classic',
            'Alfred Dunhill Links Championship',
            'Italian Open',
            'Mutuactivos Open de España',
            'Volvo China Open',
            'Nedbank Golf Challenge hosted by Gary Player',
            'DP World Tour Championship, Dubai',
            'Hero Indian Open',
            'Maybank Championship',
            'Made in HimmerLand presented by FREJA',
            'Made in Denmark presented by FREJA',
            'D+D Real Czech Masters',
            'Open de Portugal at Royal Óbidos',
            'Open de España',
            'Tenerife Open',
            'Gran Canaria Lopesan Open',
            'Austrian Golf Open',
            'Betfred British Masters',
            'Scandinavian Mixed Hosted by Henrik & Annika',
            'BMW International Open',
            'Dubai Duty Free Irish Open',
            'Aberdeen Standard Investments Scottish Open',
            'The 149th Open'
        ];
    }

    public function generateTournament($years, $tour, $tournaments) {
        foreach ($years as $year) {
            foreach ($tournaments as $tournament) {

                $tour_id = Tour::where('name', $tour)->first()->id;

                $model = Tournament::factory()
                ->year($year)
                ->create([
                    'tour_id' => $tour_id,
                    'name' => $tournament
                ]);

                // if end date is past now, add leaderboard with random players (but must be unique)
                if ($model->end_date < now()) {

                    $points = 400;

                    foreach (range(1, 100) as $rank) {

                        $points -= rand(1, 10);

                        $player_id = rand(1, 200);
                        while (TournamentLeaderboard::where('player_id', $player_id)->where('tournament_id', $model->id)->exists()) {
                            $player_id = rand(1, 200);
                        }

                        $model->leaderboard()->create([
                            'player_id' => $player_id,
                            'rank' => $rank,
                            'points_total' => $points
                        ]);
                    }
                }
            }
        }
    }
}
