<?php

use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('awards')->insert([
        	'uuid' => 'd3ff4418-01a0-4f56-bb25-a609cb431b25',
        	'nama' => 'Award 1',
        	'url_award' => 'https://yb6-dxc.net/wp-content/uploads/2020/06/sildenews1.jpg',
        	'url_gambar' => 'https://yb6-dxc.net/wp-content/uploads/2020/06/sildenews1.jpg',
        	'category' => 'free',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('awards')->insert([
        	'uuid' => 'd3ff4418-01a0-4f56-bb25-a609cb431b26',
        	'nama' => 'Award 2',
        	'url_award' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/president-Award.jpg',
        	'url_gambar' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/president-Award.jpg',
        	'category' => 'free',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('awards')->insert([
        	'uuid' => 'd3ff4418-01a0-4f56-bb25-a609cb431b24',
        	'nama' => 'Award 3',
        	'url_award' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/PBA-Award-2.jpg',
        	'url_gambar' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/PBA-Award-2.jpg',
        	'category' => 'free',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('awards')->insert([
        	'uuid' => 'd3ff4418-01a0-4f56-bb25-a609cb431b27',
        	'nama' => 'Award 4',
        	'url_award' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/PSA-Award.jpg',
        	'url_gambar' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/PSA-Award.jpg',
        	'category' => 'free',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('awards')->insert([
        	'uuid' => 'd3ff4418-01a0-4f56-bb25-a609cb431b28',
        	'nama' => 'Award 5',
        	'url_award' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/PGA-Award-366x366.jpg',
        	'url_gambar' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/PGA-Award-366x366.jpg',
        	'category' => 'free',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);

        DB::table('awards')->insert([
        	'uuid' => 'd3ff4418-01a0-4f56-bb25-a609cb431b29',
        	'nama' => 'Award 6',
        	'url_award' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/PGA-Award-366x366.jpg',
        	'url_gambar' => 'https://yb6-dxc.net/wp-content/uploads/2020/05/PGA-Award-366x366.jpg',
        	'category' => 'free',
        	'created_at' => date('Y-m-d H:i:s'),
        	'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
