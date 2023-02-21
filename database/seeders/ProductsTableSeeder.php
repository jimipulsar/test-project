<?php

namespace Database\Seeders;

use App\Models\ArchivedUser;
use App\Models\AttributeProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $faker = Faker::create();
        $this->users = User::all();
        $this->archived_user = ArchivedUser::all();

        for ($i = 1; $i <= 5; $i++) {
            $title = $faker->sentence(1);
            $slug = Str::slug($title);

            Product::create([

                'item_name' => $title,
                'slug' => $slug,
                'user_id' => $this->users[rand(0, count($this->users) - 1)]->id,
                'archived_user_id' => $this->archived_user[rand(0, count($this->archived_user) - 1)]->id,
                'price' => mt_rand(99, 4999) / 100,
                'item_code' => $faker->numberBetween($min = 1, $max = 4523523),
                'img_01' => $faker->image('public/images', 640, 480, null, false),
                'published' => (bool)rand(0, 1),
                'shippable' => (bool)rand(0, 1),
                'quantity' => $faker->numberBetween($min = 1, $max = 45),

            ]);

        }
    }
}
