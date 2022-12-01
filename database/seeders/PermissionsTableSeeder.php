<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'parent_id' => NULL,
                'name' => 'ms_manage_user',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'parent_id' => 1,
                'name' => 'ms_view_user',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => '2022-11-23 03:17:08',
            ),
            2 => 
            array (
                'id' => 3,
                'parent_id' => 1,
                'name' => 'ms_create_user',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'parent_id' => 1,
                'name' => 'ms_edit_user',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'parent_id' => 1,
                'name' => 'ms_delete_user',
                'guard_name' => 'web',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'parent_id' => 1,
                'name' => 'ms_assign_role_to_user',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            6 => 
            array (
                'id' => 7,
                'parent_id' => 1,
                'name' => 'ms_assign_permission_to_user',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            7 => 
            array (
                'id' => 8,
                'parent_id' => NULL,
                'name' => 'ms_manage_permission',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            8 => 
            array (
                'id' => 9,
                'parent_id' => 8,
                'name' => 'ms_view_permission',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            9 => 
            array (
                'id' => 10,
                'parent_id' => 8,
                'name' => 'ms_create_permission',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            10 => 
            array (
                'id' => 11,
                'parent_id' => 8,
                'name' => 'ms_edit_permission',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            11 => 
            array (
                'id' => 12,
                'parent_id' => 8,
                'name' => 'ms_delete_permission',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            12 => 
            array (
                'id' => 13,
                'parent_id' => NULL,
                'name' => 'ms_manage_role',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            13 => 
            array (
                'id' => 14,
                'parent_id' => 13,
                'name' => 'ms_view_role',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            14 => 
            array (
                'id' => 15,
                'parent_id' => 13,
                'name' => 'ms_create_role',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            15 => 
            array (
                'id' => 16,
                'parent_id' => 13,
                'name' => 'ms_edit_role',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            16 => 
            array (
                'id' => 17,
                'parent_id' => 13,
                'name' => 'ms_delete_role',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            17 => 
            array (
                'id' => 18,
                'parent_id' => 13,
                'name' => 'ms_assign_permission_to_role',
                'guard_name' => 'web',
                'created_at' => '2022-11-23 03:20:29',
                'updated_at' => '2022-11-23 03:20:29',
            ),
            18 => 
            array (
                'id' => 20,
                'parent_id' => NULL,
                'name' => 'manage_blog_post',
                'guard_name' => 'web',
                'created_at' => '2022-11-29 02:11:10',
                'updated_at' => '2022-11-29 02:11:10',
            ),
        ));
        
        
    }
}