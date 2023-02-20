<?php

namespace Database\Seeders;

use App\Models\ArchivedUser;
use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Database\Factories\ArchivedUsersFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(20)->create();
        ArchivedUser::factory()->count(1)->create();

        $this->call(UsersTableSeeder::class);
        $this->call(CustomerTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
