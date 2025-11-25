<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/districts_1764007681191.json'));
        $data = json_decode($json, true);
        
        $districts = [];
        
        foreach ($data as $district) {
            $districts[] = [
                'id' => $district['id'],
                'division_id' => $district['division_id'],
                'name' => $district['name'],
                'bn_name' => $district['bn_name'] ?? null,
                'lat' => $district['lat'] ?? null,
                'lon' => $district['lon'] ?? null,
                'url' => $district['url'] ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ];
            
            if (count($districts) >= 100) {
                \DB::table('districts')->insert($districts);
                $districts = [];
            }
        }
        
        if (!empty($districts)) {
            \DB::table('districts')->insert($districts);
        }
    }
}
