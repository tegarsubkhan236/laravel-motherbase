<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'TEGAR SUBKHAN FAUZI',
                'username' => 'tegarsubkhan',
                'email' => 'tegarsubkhan236@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$7nM586fMmtBSi14xb4ZCyO9r3RSkwd/jwseLY/6GF14u3HHDoz/DO',
                'status' => 1,
                'remember_token' => NULL,
                'created_at' => '2022-11-22 04:33:27',
                'updated_at' => '2022-11-22 06:32:10',
            ),
        ));
        
        
    }
}