<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_awards')->insert([
        	'user_id' => 2,
        	'award_id' => 1,
        	'link_googledrive' => 'https://google.com',
        ]);

        DB::table('user_awards')->insert([
        	'user_id' => 2,
        	'award_id' => 2,
        	'link_googledrive' => 'https://google.com',
        ]);

        DB::table('user_awards')->insert([
        	'user_id' => 2,
        	'award_id' => 3,
        	'link_googledrive' => 'https://google.com',
        ]);
    }
}
