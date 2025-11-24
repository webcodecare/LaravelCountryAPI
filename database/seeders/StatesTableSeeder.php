<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/countrystates_1764007681190.json'));
        $data = json_decode($json, true);
        
        $states = [];
        
        foreach ($data['data'] as $countryData) {
            $country = \DB::table('countries')
                ->where('name', $countryData['name'])
                ->first();
            
            if ($country && isset($countryData['states']) && is_array($countryData['states'])) {
                foreach ($countryData['states'] as $state) {
                    $states[] = [
                        'country_id' => $country->id,
                        'name' => $state['name'],
                        'state_code' => $state['state_code'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now()
                    ];
                    
                    if (count($states) >= 500) {
                        \DB::table('states')->insert($states);
                        $states = [];
                    }
                }
            }
        }
        
        if (!empty($states)) {
            \DB::table('states')->insert($states);
        }
    }
}
