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
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CountrySeeder::class,
            GolfSeeder::class
        ]);
    }
}
