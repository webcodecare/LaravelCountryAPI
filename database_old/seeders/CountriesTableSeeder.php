<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $countryCodesJson = file_get_contents(database_path('seeders/countrycode_1764007681189.json'));
        $countryStatesJson = file_get_contents(database_path('seeders/countrystates_1764007681190.json'));
        
        $countryCodesData = json_decode($countryCodesJson, true);
        $countryStatesData = json_decode($countryStatesJson, true);
        
        $countries = [];
        $countryMap = [];
        
        foreach ($countryCodesData['data'] as $country) {
            $key = $country['name'];
            $countryMap[$key] = [
                'name' => $country['name'],
                'code' => $country['code'] ?? null,
                'dial_code' => $country['dial_code'] ?? null,
                'iso3' => null
            ];
        }
        
        foreach ($countryStatesData['data'] as $country) {
            $key = $country['name'];
            if (isset($countryMap[$key])) {
                $countryMap[$key]['iso3'] = $country['iso3'] ?? null;
            } else {
                $countryMap[$key] = [
                    'name' => $country['name'],
                    'code' => null,
                    'dial_code' => null,
                    'iso3' => $country['iso3'] ?? null
                ];
            }
        }
        
        foreach ($countryMap as $country) {
            $countries[] = [
                'name' => $country['name'],
                'code' => $country['code'],
                'dial_code' => $country['dial_code'],
                'iso3' => $country['iso3'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        
        foreach (array_chunk($countries, 100) as $chunk) {
            DB::table('countries')->insert($chunk);
        }
    }
}
