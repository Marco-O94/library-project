<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use App\Models\Role;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Attach to user
        User::all()->each(function ($user) {
            $user->student()->save(Student::factory()->make());
            // User where role is student
            $user->roles()->where('name', 'Student')->each(function ($user) {
                $user->student()->save(Student::factory()->make());
            });
        });
    }
}
