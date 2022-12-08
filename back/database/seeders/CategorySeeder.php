<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Book Categories
        $categories = [
            'Fiction',
            'Non-Fiction',
            'Biography',
            'History',
            'Science',
            'Technology',
            'Mathematics',
            'Engineering',
            'Medicine',
            'Arts',
            'Literature',
            'Philosophy',
            'Religion',
            'Social Sciences',
            'Language',
            'Law',
            'Business',
            'Economics',
            'Education',
            'Psychology',
            'Geography',
            'Environment',
            'Politics',
            'Military',
            'Sports',
            'Entertainment',
            'Travel',
        ];

        $colors = [
            'red',
            'orange',
            'yellow',
            'green',
            'blue',
            'indigo',
            'violet',
        ];

        foreach($categories as $cat) {
            $category = new Category();
            $category->name = $cat;
            $category->slug = Str::slug($cat);
            $category->color = $colors[array_rand($colors)];
            $category->save();
        }
    }
}
