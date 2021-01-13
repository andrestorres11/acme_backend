<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statu')->insert([
            'statu_name' => 'activo',
            'statu_encrypted' => 'zdxfzdfzd',
            'statu_creationDate'=>date('Y-m-d H:i:s'),
        ]);

        DB::table('statu')->insert([
            'statu_name' => 'inactivo',
            'statu_encrypted' => 'erdgzgzxg',
            'statu_creationDate'=>date('Y-m-d H:i:s'),
        ]);
    }
}
