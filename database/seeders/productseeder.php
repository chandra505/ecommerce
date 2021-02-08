<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class productseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
                'name'=>'Samsung',
                'price'=>'200',
                'description'=>'A Smartphone with 4gb RAM',
                'category'=>'mobile',
                'gallery'=>"https://ibb.co/gr312BK",
            ],
            [
                'name'=>'Lg',
                'price'=>'200',
                'description'=>'A Smartphone with 4gb RAM',
                'category'=>'mobile',
                'gallery'=>"https://ibb.co/gr312BK",
            ],
            [
                'name'=>'Samsung',
                'price'=>'200',
                'description'=>'A Smartphone with 4gb RAM',
                'category'=>'mobile',
                'gallery'=>"https://ibb.co/gr312BK",
            ]
        ]);
    }
}
