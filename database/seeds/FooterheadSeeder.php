<?php

use App\Footerhead;
use Illuminate\Database\Seeder;

class FooterheadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = [
            ['title' => 'Know Us Better'],
            ['title' => 'Customer Service'],
            ['title' => 'Need Our Help'],
            ['title' => 'Special Offer'],
        ];
        Footerhead::insert($title);
    }
}
