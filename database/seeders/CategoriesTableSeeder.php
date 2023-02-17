<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 3; $i++) {
            $name = $faker->sentence(3);
            $slug = Str::slug($name);
            $category = Category::create([
                'name'        => $name,
                'category_slug' => $slug ,
            ]);

            for ($j = 1; $j <= 3; $j++) {
                $name1 = $faker->sentence(2);
                $slug1 = Str::slug($name1);
                $childCategory = $category->childCategories()->create([
                    'name'        =>   $name1 ,
                    'category_slug' =>   $slug1,
                ]);

                for ($k = 1; $k <= 3; $k++) {
                    $name2 = $faker->sentence(3);
                    $slug2 = Str::slug($name2);
                    $childCategory->childCategories()->create([
                        'name'        =>  $name2,
                        'category_slug' =>     $slug2,
                    ]);
                }
            }
        }



    }
}
