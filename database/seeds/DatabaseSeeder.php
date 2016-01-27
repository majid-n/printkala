<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cats')->insert([

            [ 'title' => 'کاغذ' ],
            [ 'title' => 'زینک' ],
            [ 'title' => 'مرکب چاپ' ],

        ]);

        DB::table('products')->insert([ 
    		[
                'name' 		=> 'کاغذ A4 Copymax',
                'des' 		=> 'کاغذ A4 Copymax کاغذ A4 Copymax کاغذ A4 Copymax',
                'cat' 		=> 1,
                'size' 		=> '210x297',
                'weight'    => 80,
                'price' 	=> 6500,
                'pic' 		=> 'copimax.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'کاغذ A4 DoubleA',
                'des' 		=> 'کاغذ A4 DoubleA کاغذ A4 DoubleA کاغذ A4 DoubleA',
                'cat' 		=> 1,
                'size' 		=> '210x297',
                'weight'    => 80,
                'price' 	=> 8800,
                'pic' 		=> 'doublea.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'زینک GTO',
                'des' 		=> 'زینک GTO زینک GTO زینک GTO',
                'cat' 		=> 2,
                'size' 		=> '326x256',
                'weight'    => 213,
                'price' 	=> 23000,
                'pic' 		=> 'zinctest.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'کاغذ JKcmax',
                'des' 		=> 'کاغذ JKcmax کاغذ JKcmax کاغذ JKcmax',
                'cat' 		=> 1,
                'size' 		=> '210x297',
                'weight'    => 80,
                'price' 	=> 11500,
                'pic' 		=> 'jkcmax.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'زینک دو ورقی',
                'des' 		=> 'زینک دو ورقی زینک دو ورقی زینک دو ورقی',
                'cat' 		=> 2,
                'size' 		=> '544x456',
                'weight'    => 253,
                'price' 	=> 15000,
                'pic' 		=> 'GH-TP-II.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'زینگ دو و نیم ورقی اسپید',
                'des' 		=> 'زینگ دو و نیم ورقی اسپید زینگ دو و نیم ورقی اسپید زینگ دو و نیم ورقی اسپید',
                'cat' 		=> 2,
                'size' 		=> '700x500',
                'weight'    => 315,
                'price' 	=> 100000,
                'pic' 		=> 'HG-TD-G.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'مرکب Huaguang',
                'des' 		=> 'مرکب Huaguang مرکب Huaguang مرکب Huaguang',
                'cat' 		=> 3,
                'size' 		=> '454',
                'weight'    => 4545,
                'price' 	=> 140000,
                'pic' 		=> 'uv1.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'مرکب Huaguang 1',
                'des' 		=> 'مرکب Huaguang 1 مرکب Huaguang 1 مرکب Huaguang 1',
                'cat' 		=> 3,
                'size' 		=> '4564',
                'weight'    => 345,
                'price' 	=> 145000,
                'pic' 		=> 'uv2.jpg',
                'active' 	=> 1,
            ],
        ]);
    }
}
