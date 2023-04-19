<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\CountryLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

            $model = Country::firstOrCreate([
                'code' => $country['code'],
            ]);

            // en, de, es, fr, nl, it
            CountryLanguage::firstOrCreate([
                'country_id' => $model->id,
                'language' => 'en',
                'name' => $country['en']
            ]);
            CountryLanguage::firstOrCreate([
                'country_id' => $model->id,
                'language' => 'de',
                'name' => $country['de']
            ]);
            CountryLanguage::firstOrCreate([
                'country_id' => $model->id,
                'language' => 'es',
                'name' => $country['es']
            ]);
            CountryLanguage::firstOrCreate([
                'country_id' => $model->id,
                'language' => 'fr',
                'name' => $country['fr']
            ]);
            CountryLanguage::firstOrCreate([
                'country_id' => $model->id,
                'language' => 'nl',
                'name' => $country['nl']
            ]);
            CountryLanguage::firstOrCreate([
                'country_id' => $model->id,
                'language' => 'it',
                'name' => $country['it']
            ]);
        }
    }
}
