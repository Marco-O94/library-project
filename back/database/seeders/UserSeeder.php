<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // Admin user
        \App\Models\User::create([

            'name' => 'Admin',
            'is_admin' => true,
            'email' => 'admin@localhost',
            'password' => bcrypt('password'),
        ]);

        \App\Models\User::factory(10)->create()->each(function ($user) {
            $user->roles()->attach(\App\Models\Role::where('name', 'Guest')->first());
        });
    }
}
