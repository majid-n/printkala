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
            'email'         => 'user@user.com',
            'password'      => 'user123',
            'first_name'    => 'علی',
            'last_name'     => 'شفیعی',
            'address1'      => 'مجیدیه شمالی نرسیده به میدان سرباز کوچه شهید داوود علی بخشی پلاک 55 طبقه اول',
            'address2'      => 'سعادت آباد، کوی فراز شماره 86 بلوک 4 طبقه دوم واحد 4',
            'address3'      => 'سعدی جنوبی کوچه بانک تجارت پلاک 3 طبقه دوم',
        ]);
        Sentinel::registerAndActivate([
            'email'         => 'admin@admin.com',
            'password'      => 'admin123',
            'first_name'    => 'مجید',
            'last_name'     => 'نورعلی',
            'address1'      => 'مجیدیه شمالی نرسیده به میدان سرباز کوچه شهید داوود علی بخشی پلاک 55 طبقه اول',
            'address2'      => 'سعادت آباد، کوی فراز شماره 86 بلوک 4 طبقه دوم واحد 4',
            'address3'      => 'سعدی جنوبی کوچه بانک تجارت پلاک 3 طبقه دوم',
        ]);
        $this->command->info('Users seeded!');

        # Role Seeder
        DB::table('roles')->delete();
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'users',
            'slug' => 'users',
        ]);
        Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'admins',
            'slug' => 'admins',
        ]);
        $this->command->info('Roles seeded!');

        # User Role Seeder
        DB::table('role_users')->delete();
        $user  = Sentinel::findByCredentials(['login' => 'user@user.com']);
        $admin = Sentinel::findByCredentials(['login' => 'admin@admin.com']);

        $userRole  = Sentinel::findRoleByName('users');
        $adminRole = Sentinel::findRoleByName('admins');

        $userRole->users()->attach($user);
        $adminRole->users()->attach($admin);
        $this->command->info('Users assigned to roles seeded!');

        # Categories Table Seeder
        DB::table('cats')->delete();
        DB::table('cats')->insert([
            [ 'title' => 'کاغذ' ],
            [ 'title' => 'زینک' ],
            [ 'title' => 'مرکب' ],
        ]);
        $this->command->info('Categories Table Seeded.');

        # Orders Table Seeder
        DB::table('orders')->delete();
        DB::table('orders')->insert([
            [ 
                'user_id'   => '2',
                'sum'       => '208600',
                'address'   => 'سعدی جنوبی کوچه بانک تجارت پلاک 3 طبقه دوم',
                'status'    => '1'
            ],
            [ 
                'user_id'   => '2',
                'sum'       => '145500',
                'address'   => 'مجیدیه شمالی نرسیده به میدان سرباز کوچه شهید داوود علی بخشی پلاک 55 طبقه اول',
                'status'    => '0'
            ],
            [ 
                'user_id'   => '2',
                'sum'       => '650000',
                'address'   => 'سعدی جنوبی کوچه بانک تجارت پلاک 3 طبقه دوم',
                'status'    => '0'
            ],
        ]);
        $this->command->info('Orders Table Seeded.');

        # Products Table Seeder
        DB::table('products')->delete();
        DB::table('products')->insert([ 
    		[
                'name' 		=> 'کاغذ A4 Copymax',
                'des' 		=> 'کاغذ A4 Copymax کاغذ A4 Copymax کاغذ A4 Copymax',
                'cat_id' 	=> 1,
                'size' 		=> '210x297',
                'weight'    => 80,
                'price' 	=> 6500,
                'pic' 		=> 'copimax.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'کاغذ A4 DoubleA',
                'des' 		=> 'کاغذ A4 DoubleA کاغذ A4 DoubleA کاغذ A4 DoubleA',
                'cat_id' 	=> 1,
                'size' 		=> '210x297',
                'weight'    => 80,
                'price' 	=> 8800,
                'pic' 		=> 'doublea.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'زینک GTO',
                'des' 		=> 'زینک GTO زینک GTO زینک GTO',
                'cat_id' 	=> 2,
                'size' 		=> '326x256',
                'weight'    => 213,
                'price' 	=> 23000,
                'pic' 		=> 'zinc1.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'کاغذ JKcmax',
                'des' 		=> 'کاغذ JKcmax کاغذ JKcmax کاغذ JKcmax',
                'cat_id' 	=> 1,
                'size' 		=> '210x297',
                'weight'    => 80,
                'price' 	=> 11500,
                'pic' 		=> 'jkcmax.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'زینک دو ورقی',
                'des' 		=> 'زینک دو ورقی زینک دو ورقی زینک دو ورقی',
                'cat_id' 	=> 2,
                'size' 		=> '544x456',
                'weight'    => 253,
                'price' 	=> 15000,
                'pic' 		=> 'zinc2.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'زینگ دو و نیم ورقی اسپید',
                'des' 		=> 'زینگ دو و نیم ورقی اسپید زینگ دو و نیم ورقی اسپید زینگ دو و نیم ورقی اسپید',
                'cat_id' 	=> 2,
                'size' 		=> '700x500',
                'weight'    => 315,
                'price' 	=> 100000,
                'pic' 		=> 'zinc3.jpg',
                'active' 	=> 1,
            ],
            [
                'name'      => 'زینگ چهار و نیم ورقی',
                'des'       => 'زینگ چهار و نیم ورقی زینگ چهار و نیم ورقی زینگ چهار و نیم ورقی',
                'cat_id'    => 2,
                'size'      => '700x500',
                'weight'    => 315,
                'price'     => 140000,
                'pic'       => 'zinc4.jpg',
                'active'    => 1,
            ],
            [
                'name' 		=> 'مرکب Huaguang',
                'des' 		=> 'مرکب Huaguang مرکب Huaguang مرکب Huaguang',
                'cat_id' 	=> 3,
                'size' 		=> '454',
                'weight'    => 4545,
                'price' 	=> 140000,
                'pic' 		=> 'uv1.jpg',
                'active' 	=> 1,
            ],
            [
                'name' 		=> 'مرکب Huaguang 1',
                'des' 		=> 'مرکب Huaguang 1 مرکب Huaguang 1 مرکب Huaguang 1',
                'cat_id' 	=> 3,
                'size' 		=> '4564',
                'weight'    => 345,
                'price' 	=> 145000,
                'pic' 		=> 'uv2.jpg',
                'active' 	=> 1,
            ],
            [
                'name'      => 'مرکب چاپ',
                'des'       => 'مرکب چاپ مرکب چاپ مرکب چاپ',
                'cat_id'    => 3,
                'size'      => '4564',
                'weight'    => 345,
                'price'     => 125000,
                'pic'       => 'uv3.jpg',
                'active'    => 1,
            ],
        ]);
        $this->command->info('Products Seeded.');

        # Units Table Seeder
        DB::table('units')->delete();
        DB::table('units')->insert([
            [ 'title' => 'بسته' ],
            [ 'title' => 'کارتن' ],
            [ 'title' => 'بند' ],
            [ 'title' => 'گالن' ],
            [ 'title' => 'جعبه' ],
        ]);
        $this->command->info('Units Table Seeded.');

        # Unit Cats Table Seeder
        DB::table('unit_cats')->delete();
        DB::table('unit_cats')->insert([
            [ 
                'cat_id'    => '1',
                'unit_id'   => '1',
            ],
            [ 
                'cat_id'    => '1',
                'unit_id'   => '2',
            ],
            [ 
                'cat_id'    => '1',
                'unit_id'   => '3',
            ],
            [ 
                'cat_id'    => '2',
                'unit_id'   => '1',
            ],
            [ 
                'cat_id'    => '3',
                'unit_id'   => '4',
            ],
        ]);
        $this->command->info('Unit_Cats Table Seeded.');

    }
}
