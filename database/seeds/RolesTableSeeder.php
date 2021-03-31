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
        $adminRole = Role::create([
            'name'        => 'Admin',
            'slug'        => 'admin',
            'description' => 'Admin Role',
            'level'       => 5,
        ]);

        $userRole = Role::create([
            'name'        => 'Manager',
            'slug'        => 'manager',
            'description' => 'Manager Role',
            'level'       => 1,
        ]);


        $userRole = Role::create([
            'name'        => 'Unverified',
            'slug'        => 'unverified',
            'description' => 'Unverified Role',
            'level'       => 0,
        ]);

    }
}
