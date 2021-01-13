<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
        	'userType_id' => '1',
            'user_name' => 'admin',
            'user_lastName' => 'acme',
            'user_identity' => '45678952',
            'user_cellphone' => '45454952',
            'user_city' => 'cartagena',
            'user_address' => 'bruselas',
            'user_password' => '123456',
            'user_email' => 'admin@acme.com',
            'user_encrypted' => 'sdbbsibfkhjsukl',
            'user_creationDate'=>date('Y-m-d H:i:s'),
        ]);
    }
}
