<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/divisions_1764007681193.json'));
        $data = json_decode($json, true);
        
        $divisions = [];
        
        foreach ($data as $division) {
            $divisions[] = [
                'id' => $division['id'],
                'name' => $division['name'],
                'bn_name' => $division['bn_name'] ?? null,
                'url' => $division['url'] ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        
        \DB::table('divisions')->insert($divisions);
    }
}
