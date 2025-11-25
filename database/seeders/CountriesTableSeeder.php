<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $countriesJson = file_get_contents(database_path('seeders/complete_countries_data.json'));
        $countriesData = json_decode($countriesJson, true);
        
        $countries = [];
        
        foreach ($countriesData['data'] as $country) {
            $countries[] = [
                'name' => $country['name'],
                'code' => $country['code'] ?? null,
                'iso3' => $country['iso3'] ?? null,
                'numeric_code' => $country['numeric_code'] ?? null,
                'dial_code' => $country['dial_code'] ?? null,
                'flag' => $country['flag'] ?? null,
                'capital' => $country['capital'] ?? null,
                'currency' => $country['currency'] ?? null,
                'currency_name' => $country['currency_name'] ?? null,
                'currency_symbol' => $country['currency_symbol'] ?? null,
                'tld' => $country['tld'] ?? null,
                'native' => $country['native'] ?? null,
                'region' => $country['region'] ?? null,
                'subregion' => $country['subregion'] ?? null,
                'timezones' => $country['timezones'] ?? null,
                'latitude' => $country['latitude'] ?? null,
                'longitude' => $country['longitude'] ?? null,
                'emoji' => $country['emoji'] ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        
        DB::table('countries')->truncate();
        
        foreach (array_chunk($countries, 100) as $chunk) {
            DB::table('countries')->insert($chunk);
        }
    }
}
