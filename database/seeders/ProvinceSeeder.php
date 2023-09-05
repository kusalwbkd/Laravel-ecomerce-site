<?php

namespace Database\Seeders;

use App\Models\Provice;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['id' => 1, 'name_en' => 'Western', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
            ['id' => 2, 'name_en' => 'Central', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
            ['id' => 3, 'name_en' => 'Southern', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
            ['id' => 4, 'name_en' => 'North Western', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
            ['id' => 5, 'name_en' => 'Sabaragamuwa', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
            ['id' => 6, 'name_en' => 'Eastern', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
            ['id' => 7, 'name_en' => 'Uva', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
            ['id' => 8, 'name_en' => 'North Central', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
            ['id' => 9, 'name_en' => 'Northern', 'created_at' => '2022-11-29 15:51:57', 'updated_at' => '2022-11-29 15:51:57'],
        ];

        foreach ($datas as $data) {
            Provice::create($data);
        }
    }
}
