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
            
            $role = 1;

            if ($i > 10) {
                $role = 2;    
            }

            DB::table('users')->insert([
                'member_id' => '00'.$i.'',
                'name' => 'Tilis Tiadi'.$i.'',
                'email' => 'tilistiadi'.$i.'@gmail.com',
                'password' => Hash::make('password'),
                'category' => 'member',
                'callsign' => 'YB'.$i.'DC',
                'role' => $role,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);   
        }
    }
}
