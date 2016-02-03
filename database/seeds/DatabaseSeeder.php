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
        # User Seeder
        Sentinel::registerAndActivate([
            'email'    => 'user@user.com',
            'password' => 'user',
            'first_name' => 'UserFirstName',
            'last_name' => 'UserLastName',
        ]);
        Sentinel::registerAndActivate([
            'email'    => 'admin@admin.com',
            'password' => 'admin',
            'first_name' => 'AdminFirstName',
            'last_name' => 'AdminLastName',
        ]);
        $this->command->info('Users seeded!');

        # Role Seeder
        DB::table('roles')->delete();
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Users',
            'slug' => 'users',
        ]);
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Admins',
            'slug' => 'admins',
        ]);
        $this->command->info('Roles seeded!');

        # User Role Seeder
        DB::table('role_users')->delete();
        $user  = Sentinel::findByCredentials(['login' => 'user@user.com']);
        $admin = Sentinel::findByCredentials(['login' => 'admin@admin.com']);

        $userRole  = Sentinel::findRoleByName('Users');
        $adminRole = Sentinel::findRoleByName('Admins');

        $userRole->users()->attach($user);
        $adminRole->users()->attach($admin);
        $this->command->info('Users assigned to roles seeded!');

        # Categories Table Seeder
        DB::table('cats')->delete();
        DB::table('cats')->insert([
            [ 'title' => 'کاغذ' ],
            [ 'title' => 'زینک' ],
            [ 'title' => 'مرکب چاپ' ],
        ]);
        $this->command->info('Categories Table Seeded.');

        # Products Table Seeder
        DB::table('products')->delete();
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
        $this->command->info('Products Seeded.');
    }
}
