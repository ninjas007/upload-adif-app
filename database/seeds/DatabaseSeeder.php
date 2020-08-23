<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $this->call(AwardSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(UserAwardSeeder::class);
    }
}
