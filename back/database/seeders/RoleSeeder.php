<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $roles = [
            [
                'name' => 'Librarian',
                'color' => 'green',
            ],
            [
                'name' => 'Student',
                'color' => 'blue',
            ],
            [
                'name' => 'Guest',
                'color' => 'orange',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
