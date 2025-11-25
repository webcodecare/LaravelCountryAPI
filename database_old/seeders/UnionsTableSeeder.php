<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/unions_1764007681194.json'));
        $data = json_decode($json, true);
        
        $unions = [];
        
        foreach ($data as $union) {
            $unions[] = [
                'id' => $union['id'],
                'upazilla_id' => $union['upazilla_id'],
                'name' => $union['name'],
                'bn_name' => $union['bn_name'] ?? null,
                'url' => $union['url'] ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ];
            
            if (count($unions) >= 500) {
                \DB::table('unions')->insert($unions);
                $unions = [];
            }
        }
        
        if (!empty($unions)) {
            \DB::table('unions')->insert($unions);
        }
    }
}
