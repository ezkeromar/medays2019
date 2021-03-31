<?php

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Permission;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $adminRole = Role::whereSlug('admin')->first();
        $managerRole = Role::whereSlug('manager')->first();
        $permissions = config('roles.models.permission')::all();

        /** @var \App\Models\User $admin */
        $admin = User::create([
            'name'                           => "Admin",
            'first_name'                     => 'Admin',
            'last_name'                      => 'Reeventy',
            'email'                          => 'admin@reeventy.com',
            'password'                       => bcrypt('password'),
            'token'                          => str_random(64),
            'remember_token'                 => str_random(10),
            'activated'                      => true,
            'signup_confirmation_ip_address' => $faker->ipv4,
            'admin_ip_address'               => $faker->ipv4,
        ]);

        $admin->profile()->save(new Profile());
        $admin->attachRole($adminRole);
        foreach ($permissions as $permission) {
            $admin->attachPermission($permission);
        }

        /** @var User $manager */
        $manager = User::create([
            'name'                           => 'Manager',
            'first_name'                     => 'Manager',
            'last_name'                      => 'Reeventy',
            'email'                          => 'manager@reeventy.com',
            'password'                       => bcrypt('password'),
            'token'                          => str_random(64),
            'remember_token'                 => str_random(10),
            'activated'                      => true,
            'signup_ip_address'              => $faker->ipv4,
            'signup_confirmation_ip_address' => $faker->ipv4,
        ]);

        $manager->profile()->save(new Profile());
        $manager->attachRole($managerRole);


       /* factory(App\Models\User::class, 50)->create()->each(function (User $user) use ($managerRole) {
            $user->attachRole($managerRole);
            $user->attachPermission(Permission::inRandomOrder()->limit(4)->get());
        });*/

    }
}
