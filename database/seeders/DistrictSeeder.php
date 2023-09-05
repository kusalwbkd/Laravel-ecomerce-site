<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas =
            [
    ['id'=>'1','province_id'=>'6','name_en'=>'Ampara','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'2','province_id'=>'8','name_en'=>'Anuradhapura','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'3','province_id'=>'7','name_en'=>'Badulla','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'4','province_id'=>'6','name_en'=>'Batticaloa','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'5','province_id'=>'1','name_en'=>'Colombo','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'6','province_id'=>'3','name_en'=>'Galle','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'7','province_id'=>'1','name_en'=>'Gampaha','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'8','province_id'=>'3','name_en'=>'Hambantota','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'9','province_id'=>'9','name_en'=>'Jaffna','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'10','province_id'=>'1','name_en'=>'Kalutara','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'11','province_id'=>'2','name_en'=>'Kandy','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'12','province_id'=>'5','name_en'=>'Kegalle','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'13','province_id'=>'9','name_en'=>'Kilinochchi','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'14','province_id'=>'4','name_en'=>'Kurunegala','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'15','province_id'=>'9','name_en'=>'Mannar','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'16','province_id'=>'2','name_en'=>'Matale','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'17','province_id'=>'3','name_en'=>'Matara','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'18','province_id'=>'7','name_en'=>'Monaragala','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'19','province_id'=>'9','name_en'=>'Mullaitivu','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'20','province_id'=>'2','name_en'=>'Nuwara Eliya','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'21','province_id'=>'8','name_en'=>'Polonnaruwa','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'22','province_id'=>'4','name_en'=>'Puttalam','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'23','province_id'=>'5','name_en'=>'Ratnapura','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'24','province_id'=>'6','name_en'=>'Trincomalee','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
['id'=>'25','province_id'=>'9','name_en'=>'Vavuniya','created_at'=>'2022-11-29 15:51:57','updated_at'=>'2022-11-29 15:51:57'],
];

            foreach($datas as $data){
                District::create($data);
            }
    }
}

