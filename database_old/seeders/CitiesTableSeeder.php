<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/countrywithcities_1764007681190.json'));
        $data = json_decode($json, true);
        
        $cities = [];
        
        foreach ($data['data'] as $countryData) {
            $country = \DB::table('countries')
                ->where('name', $countryData['country'])
                ->first();
            
            if ($country && isset($countryData['cities']) && is_array($countryData['cities'])) {
                foreach ($countryData['cities'] as $city) {
                    $cities[] = [
                        'country_id' => $country->id,
                        'name' => $city,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    
                    if (count($cities) >= 500) {
                        \DB::table('cities')->insert($cities);
                        $cities = [];
                    }
                }
            }
        }
        
        if (!empty($cities)) {
            \DB::table('cities')->insert($cities);
        }
    }
}
