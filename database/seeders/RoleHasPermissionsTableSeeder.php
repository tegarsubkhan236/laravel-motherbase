<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            2 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            3 => 
            array (
                'permission_id' => 2,
                'role_id' => 3,
            ),
            4 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 3,
                'role_id' => 3,
            ),
            6 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            7 => 
            array (
                'permission_id' => 4,
                'role_id' => 3,
            ),
            8 => 
            array (
                'permission_id' => 5,
                'role_id' => 2,
            ),
            9 => 
            array (
                'permission_id' => 5,
                'role_id' => 3,
            ),
            10 => 
            array (
                'permission_id' => 6,
                'role_id' => 2,
            ),
            11 => 
            array (
                'permission_id' => 6,
                'role_id' => 3,
            ),
            12 => 
            array (
                'permission_id' => 7,
                'role_id' => 2,
            ),
            13 => 
            array (
                'permission_id' => 7,
                'role_id' => 3,
            ),
            14 => 
            array (
                'permission_id' => 8,
                'role_id' => 3,
            ),
            15 => 
            array (
                'permission_id' => 9,
                'role_id' => 2,
            ),
            16 => 
            array (
                'permission_id' => 9,
                'role_id' => 3,
            ),
            17 => 
            array (
                'permission_id' => 10,
                'role_id' => 3,
            ),
            18 => 
            array (
                'permission_id' => 11,
                'role_id' => 3,
            ),
            19 => 
            array (
                'permission_id' => 12,
                'role_id' => 3,
            ),
            20 => 
            array (
                'permission_id' => 13,
                'role_id' => 3,
            ),
            21 => 
            array (
                'permission_id' => 14,
                'role_id' => 2,
            ),
            22 => 
            array (
                'permission_id' => 14,
                'role_id' => 3,
            ),
            23 => 
            array (
                'permission_id' => 15,
                'role_id' => 3,
            ),
            24 => 
            array (
                'permission_id' => 16,
                'role_id' => 3,
            ),
            25 => 
            array (
                'permission_id' => 17,
                'role_id' => 3,
            ),
            26 => 
            array (
                'permission_id' => 18,
                'role_id' => 3,
            ),
            27 => 
            array (
                'permission_id' => 20,
                'role_id' => 3,
            ),
        ));
        
        
    }
}