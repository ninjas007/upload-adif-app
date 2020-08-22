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

            DB::table('users')->insert([
                'member_id' => '00'.$i.'',
                'name' => 'Tilis Tiadi'.$i.'',
                'email' => 'tilistiadi'.$i.'@gmail.com',
                'password' => Hash::make('password'),
                'category' => $category,
                'callsign' => 'YB'.$i.'DC',
                'role' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);   
        }
    }
}
