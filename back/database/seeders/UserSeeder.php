<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;
use App\Models\Role;
use App\Models\Category;

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
        User::create([

            'name' => 'Admin',
            'is_admin' => true,
            'email' => 'admin@localhost',
            'password' => bcrypt('password'),
        ]);

        // Generate 10 users with Guest role
            User::factory(10)->create()->each(function ($user) {
            $user->roles()->attach(Role::where('name', 'Guest')->first());
            $user->books()->attach(Book::factory(5)->create()->each(
                function ($book) {
                    $book->categories()->attach(Category::all()->random(1));
                }
            ), ['borrow_date' => now(), 'expiration_date' => now()->addDays(7)]);
        });
        // Attach categories to books

        // Generate 10 users with Student role
        /*User::factory(10)->create()->each(function ($user) {
            $user->roles()->attach(Role::where('name', 'Student')->first());

            $user->books()->attach(Book::factory(5)->count(5)->make(), ['borrow_date' => now()]);
        });*/




    }
}
