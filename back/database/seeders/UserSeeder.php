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
        // Generate 10 users with Guest role
            User::factory(10)->create()->each(function ($user) {

            $user->books()->attach(Book::factory(5)->create()->each(
                function ($book) {
                    $book->categories()->attach(Category::all()->random(1));
                }
            ), ['due_date' => now()->addDays(7)]);
        });
        // Attach categories to books

        // Admin user
        User::create([

            'name' => 'Admin',
            'is_admin' => true,
            'role_id' => Role::where('name', 'Librarian')->first()->id,
            'email' => 'admin@localhost',
            'password' => bcrypt('password'),
        ]);




    }
}
