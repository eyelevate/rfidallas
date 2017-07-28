<?php

use Carbon\Carbon;
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
            'role_id' => 1,
            'phone' => '2069315327',
        	'email' => 'onedough83@gmail.com',
        	'password' => bcrypt('0987poiu'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'first_name' => 'Edward',
            'last_name' => 'Tan',
            'role_id' => 1,
            'phone' => '7229229359',
            'email' => 'edward@utilityhub.net',
            'password' => bcrypt('utilityhub'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
