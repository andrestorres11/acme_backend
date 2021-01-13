<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_type')->insert([
            'userType_name' => 'user',
            'userType_encrypted' => 'ffgfd',
            'userType_creationDate' => date('Y-m-d H:i:s'),
        ]);
        DB::table('user_type')->insert([
            'userType_name' => 'owner',
            'userType_encrypted' => 'vnvbnv',
            'userType_creationDate' => date('Y-m-d H:i:s'),
        ]);
        DB::table('user_type')->insert([
            'userType_name' => 'driver',
            'userType_encrypted' => 'sfsdfsdf',
            'userType_creationDate' => date('Y-m-d H:i:s'),
        ]);
    }
}
