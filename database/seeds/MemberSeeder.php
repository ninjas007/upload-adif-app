<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i < 14; $i++) {
            
            $category = 'free';

            if ($i > 10) {
                $category = 'premium';    
            }

            if ($i == 3) {
                $email = 'tilistiadi03@gmail.com';
                $date = date('Y-m-d');
            } else {
                $email = 'tilistiadi'.$i.'@gmail.com';
                $date = null;
            }

            DB::table('users')->insert([
                'member_id' => '00'.$i.'',
                'name' => 'Tilis Tiadi'.$i.'',
                'email' => $email,
                'password' => Hash::make('password'),
                'category' => $category,
                'register' => $date,
                'callsign' => 'YB'.$i.'DC',
                'foto' => 'profile.jpg',
                'role' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);   
        }
    }
}
