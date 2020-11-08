<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClearfixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clearfixes')->insert([
            'title' => 'Some special product are onsale for certain time.',
            'link_title' => 'Shop Now',
            'link' => '/shops'
        ]);
    }
}
