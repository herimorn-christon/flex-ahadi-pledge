<?php

namespace Database\Seeders;

use App\Models\Jumuiya;
use App\Models\PledgeType;
use App\Models\Purpose;
use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();


        $subs = ['Fellowship', 'Sunday School', 'Wagonjwa', 'Bible Study', 'Uinjilisti', 'Tarumbeta', 'Umoja Wa Wanawake', 'Umoja Wa Vijana'];
        foreach ($subs as $sub) { Subscriptions::create(['name' => $sub]);}

        PledgeType::create(['title' => 'MONEY']);

        Purpose::create([
            'title' => 'UJENZI WA KANISA',
            'description' => 'UJENZI WA KANISA',
            'start_date' => '2023-01-08',
            'end_date' => '2023-01-31',
            'status' => '0',
            'created_by' => '1'
        ]);

        Jumuiya::create([
            'name' => 'SINZA',
            'location' => 'SINZA',
            'abbreviation' => 'SN',
        ]);

        User::create([
            'fname' => 'Alex',
            'mname' => 'Paul',
            'lname' => 'Rossi',
            'jumuiya' => '1',
            'phone' => '0717155791',
            'email' => 'kappa@gmail.com',
            'date_of_birth' => '2023-01-06',
            'password' => Hash::make('burnwood'),
            'gender' => 'MALE',
            'status' => '0',
            'role' => 'member'
        ]);

        
    }
}
