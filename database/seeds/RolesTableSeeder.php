<?php

use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        Role::truncate();

        if (Role::where('slug', '=', 'admin')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Giám đốc',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ]);
        }

        if (Role::where('slug', '=', 'mod')->first() === null) {
            $modRole = Role::create([
                'name'        => 'Trưởng phòng',
                'slug'        => 'mod',
                'description' => 'Mod Role',
                'level'       => 3,
            ]);
        }

        if (Role::where('slug', '=', 'user')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Nhân viên',
                'slug'        => 'user',
                'description' => 'User Role',
                'level'       => 1,
            ]);
        }

        // if (Role::where('slug', '=', 'unverified')->first() === null) {
        //     $userRole = Role::create([
        //         'name'        => 'Chưa xác minh',
        //         'slug'        => 'unverified',
        //         'description' => 'Unverified Role',
        //         'level'       => 0,
        //     ]);
        // }
    }
}
