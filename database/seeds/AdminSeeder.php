<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'member_id' => '',
            'name' => 'admin',
            'email' => 'admin123@gmail.com',
            'password' => Hash::make('passwordadmin123'),
            'category' => 'admin',
            'callsign' => '',
            'role' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        // DB::table('users')->insert([
        //     'name' => 'Tilis Tiadi',
        //     'email' => 'tiliztiadi@gmail.com',
        //     'password' => Hash::make('password'),
        //     'role' => 1,
        //     'foto' => 'profile.jpg',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s')
        // ]);
    }
}
