<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class dependantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table("dependants")->insert([
        [
            'fullName'=>'christon Mzeru',
            'birth_date'=>'2020-04-30',
            'relationship'=>'father',
             'users_id'=>20,
        ],
        [
            'fullName'=>'joseph Mzeru',
            'birth_date'=>'2020-04-30',
            'relationship'=>'father',
             'users_id'=>20,
        ],
        [
            'fullName'=>'kingwendu',
            'birth_date'=>'2020-04-30',
            'relationship'=>'father',
             'users_id'=>20,
        ],
        [
            'fullName'=>'matayo',
            'birth_date'=>'2020-04-30',
            'relationship'=>'father',
             'users_id'=>20,
        ]
        

      ]);
        /*
        DB::table("posts")->insert([
            'title'=>'jonathan',
            'description'=>'woow nice',
            'status'=>1,
            'published_date'=>date('y-m-d'),
            'user_id'=>1,
        ]);
         */
    }
}
