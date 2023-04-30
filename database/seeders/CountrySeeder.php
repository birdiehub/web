<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries = json_decode(Storage::get('data/countries.json'), true)['countries'];

        foreach ($countries as $country) {

            Country::firstOrCreate([
                'code' => $country['code'],
                'name' => [
                    'en' => $country['en'],
                    'de' => $country['de'],
                    'es' => $country['es'],
                    'fr' => $country['fr'],
                    'nl' => $country['nl'],
                    'it' => $country['it']
                ]
            ]);
        }
    }
}
