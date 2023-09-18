<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Profile;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Selleroption;
use App\Models\Nego;

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

        Category::create([
            'name'=>'Fashion'
         ]);
 
         Category::create([
             'name'=>'Books'
          ]);
 
         Category::create([
             'name'=>'Electronics'
          ]);
 
          Category::create([
             'name'=>'Mahallah Equipments'
          ]);
 
          Category::create([
             'name'=>'Cosmetics'
          ]);
  
          Category::create([
             'name'=>'Others'
          ]);

          Condition::create([
            'condition'=>'Brand New'
         ]);

         Condition::create([
            'condition'=>'Like New'
         ]);

         Condition::create([
            'condition'=>'Lightly Used'
         ]);

         Condition::create([
            'condition'=>'Used'
         ]);

         Condition::create([
            'condition'=>'Heavy Used'
         ]);

         Nego::create([
            'option'=>'Negotiable'
         ]);

         Nego::create([
            'option'=>'Non-Negotiable'
         ]);


         Selleroption::create([
            'name'=>'For Sale'
         ]);

         Selleroption::create([
            'name'=>'For Free'
         ]);

         Product::create([
            'product_name'=> 'H&M cardigan',
            'username'=> '1',
            'product_pic'=> '',
            'product_price' => '30',
            'option_id'=> '1',
            'category_id' => '1',
            'condition_id' => '1',
            'nego_id'=> '1',
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
            'option_id'=> '1',
            'category_id' => '1',
            'condition_id' => '1',
            'nego_id'=> '1',
            'brand'=> 'H&M',
            'material'=> 'cotton',
            'more_desc'=> ' test test', 
            'meetup_point'=> 'Mahallah Hafsa'
        ]);

       
        Profile::create([
            'username'=> '2',
            'profile_pic'=> '',
            'first_name' => 'Tasya',
            'last_name'=> 'Harris',
            'mahallah' => 'Hafsa',
            'kuliyyah' => 'KICT',
            'gender'=> 'Female',
            'phone_number'=> '0143296789',
            'bio'=> 'lorem ipsum ....'
        ]);
        
        Profile::create([
            'username'=> '1',
            'profile_pic'=> '',
            'first_name' => 'Test',
            'last_name'=> 'Laravel',
            'mahallah' => 'Hafsa',
            'kuliyyah' => 'KICT',
            'gender'=> 'Female',
            'phone_number'=> '0143296789',
            'bio'=> 'lorem ipsum ....'
        ]);
        

          
 
    }
}
