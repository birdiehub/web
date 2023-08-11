<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tournament;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournament>
 */
class TournamentFactory extends Factory
{

    protected $model = Tournament::class;

    private $tournaments = [
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
        'QBE Shootout',
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

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $year = $this->randomYear();
        $weekend = $this->randomWeekend($year);

        $result = [
            'tour_id' => $this->randomTourId(),
            'name' => $this->randomTournamentName(),
            'course_id' => Course::factory()->lazy()
        ];


        return array_merge($result, $weekend);
    }

    public function year(null|int $year) : TournamentFactory
    {
        return $this->state(function (array $attributes) use ($year) {

            $year = $attributes['year'] ?? $year ?? $this->randomYear();

            return $this->randomWeekend($year);
        });
    }

    private function randomTournamentName() : string
    {
        return $this->faker->randomElement($this->tournaments);
    }

    private function randomYear() : int
    {
        return $this->faker->numberBetween(2018, 2021);
    }

    private function randomTourId() : int
    {
        return Tour::all()->random()->id;
    }

    private function randomWeekend(int $year) : array
    {
        $startDate = $this->faker->dateTimeBetween("$year-01-01", "$year-12-31")->modify('next saturday');
        $endDate = clone $startDate;
        $endDate->modify('next sunday');

        return [
            'year' => $year,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
    }

}
