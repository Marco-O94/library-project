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

        foreach($categories as $category) {
            $category = new Category();
            $category->name = $category;
            $category->slug = Str::slug($category);
            $category->description = 'This is a description for the ' . $category . ' category.';
            $category->image = 'https://picsum.photos/500/500';
            $category->color = $colors[array_rand($colors)];
            $category->save();
        }
    }
}
