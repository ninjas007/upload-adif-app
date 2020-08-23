<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        DB::table('banners')->insert([
        	'name' => 'banner 1',
        	'url_image' => 'https://yb6-dxc.net/wp-content/uploads/2020/06/sildenews1.jpg',
        	'is_active' => 1,
        	'sort_item' => 1,
        	'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('banners')->insert([
        	'name' => 'banner 2',
        	'url_image' => 'https://images.unsplash.com/photo-1541332246502-2e99eaa96cc1?ixlib=rb-1.2.1&w=1000&q=80',
        	'is_active' => 1,
        	'sort_item' => 2,
        	'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('banners')->insert([
        	'name' => 'banner 3',
        	'url_image' => 'https://images.unsplash.com/photo-1542281286-9e0a16bb7366?ixlib=rb-1.2.1&w=1000&q=80',
        	'is_active' => 1,
        	'sort_item' => 3,
        	'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
