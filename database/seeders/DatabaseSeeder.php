<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'username'=> 'test1',
            'email' => 'test@gmail.com',
            'password'=> bcrypt('test123')
        ]);

        User::create([
            'username'=> 'tasya',
            'email' => 'tasya@gmail.com',
            'password'=> bcrypt('tasya123')
        ]);

        Product::create([
            'product_name'=> 'H&M cardigan',
            'username'=> '1',
            'product_pic'=> '',
            'product_price' => '30',
            'category' => 'fashion',
            'condition' => 'Brand New',
            'dist_option'=> 'for sale',
            'brand'=> 'H&M',
            'material'=> 'cotton',
            'more_desc'=> ' test test', 
            'meetup_point'=> 'Mahallah Hafsa'
        ]);

        Product::create([
            'product_name'=> 'H&M blouse',
            'username'=> '1',
            'product_pic'=> '',
            'product_price' => '30',
            'category' => 'fashion',
            'condition' => 'Brand New',
            'dist_option'=> 'for sale',
            'brand'=> 'H&M',
            'material'=> 'cotton',
            'more_desc'=> ' test test', 
            'meetup_point'=> 'Mahallah Hafsa'
        ]);
    }
}
