<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
        	'first_name' => 'Wondo',
        	'last_name' => 'Choung',
        	'email' => 'onedough83@gmail.com',
        	'password' => bcrypt('0987poiu')
        ]);
    }
}
