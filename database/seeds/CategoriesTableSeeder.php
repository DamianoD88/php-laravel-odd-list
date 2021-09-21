<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //array di dati
        $categories = ['Html', 'CSS', 'JS', 'Python'];

        foreach($categories as $category){
            $newCategories = new Category();
            $newCategories->name = $category;
            $slug = Str::slug($category, '-');
            $newCategories->slug = $slug;

            $newCategories->save();
        }
    }
}
