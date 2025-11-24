<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UpazilasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = file_get_contents(database_path('seeders/upazilas_1764007681195.json'));
        $data = json_decode($json, true);
        
        $upazilas = [];
        
        foreach ($data as $upazila) {
            $upazilas[] = [
                'id' => $upazila['id'],
                'district_id' => $upazila['district_id'],
                'name' => $upazila['name'],
                'bn_name' => $upazila['bn_name'] ?? null,
                'url' => $upazila['url'] ?? null,
                'created_at' => now(),
                'updated_at' => now()
            ];
            
            if (count($upazilas) >= 500) {
                \DB::table('upazilas')->insert($upazilas);
                $upazilas = [];
            }
        }
        
        if (!empty($upazilas)) {
            \DB::table('upazilas')->insert($upazilas);
        }
    }
}
