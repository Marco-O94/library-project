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
                'color' => 'Green',
            ],
            [
                'name' => 'Student',
                'color' => 'Blue',
            ],
            [
                'name' => 'Guest',
                'color' => 'Orange',
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
