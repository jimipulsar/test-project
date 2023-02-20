<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer = [

            [


                'email' => 'randomuser@github.com',
                'shipping_name' => 'Giovanni',
                'password' => bcrypt('123456'),

            ],


        ];


        foreach ($customer as $key => $value) {

            Customer::create($value);

        }
    }
}
