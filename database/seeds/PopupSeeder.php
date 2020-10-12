<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PopupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('popups')->insert([
            'title' => 'get <span>25<light>%</light></span> off',
            'short_detail' => 'Subscribe to the Need eCommerce newsletter to receive timely updates from your favorite products.',
            'image' => 'img-1.jpg',
            'status' => 1
        ]);
    }
}
