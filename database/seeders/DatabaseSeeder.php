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
use App\Models\Payment;
use App\Models\Distribution;
use App\Models\Statusorder;
use App\Models\Order;
use App\Models\Delivery;
use App\Models\Statuspayment;
use App\Models\Statusproduct;
use App\Models\Subcategorie;
use App\Models\Discussion;


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

        User::create([
         'username'=> 'admin',
         'email' => 'admin@gmail.com',
         'password'=> bcrypt('admin123'),
         'usertype'=> '1'
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

         Payment::create([
            'payment_opt'=> 'Cash'
         ]);

         Payment::create([
            'payment_opt'=> ' Online Banking'
         ]);

         Distribution::create([
            'options'=> ' For Free'
         ]);

         Distribution::create([
            'options'=> ' For Sale'
         ]);

         Statusproduct::create([
            'status'=> ' Sold'
         ]);

         Statusproduct::create([
            'status'=> 'On-Hold'
         ]);

         Statusproduct::create([
            'status'=> 'Available'
         ]);

         Statuspayment::create([
            'payment_status'=> 'Pending'
         ]);

         Statuspayment::create([
            'payment_status'=> 'Completed'
         ]);

         Statuspayment::create([
            'payment_status'=> 'Failed'
         ]);

         Statuspayment::create([
            'payment_status'=> 'Cash'
         ]);

         Statusorder::create([
            'status'=> 'Delivery'
         ]);
       
         Statusorder::create([
            'status'=> 'Received'
         ]);

         Statusorder::create([
            'status'=> 'Completed'
         ]);

         Statusorder::create([
            'status'=> 'Cancelled by Seller'
         ]);
       
         Statusorder::create([
            'status'=> 'Processing'
         ]);

         Statusorder::create([
            'status'=> 'Received by Buyer'
         ]);

         Statusorder::create([
            'status'=> 'Cancelled by Buyer'
         ]);

         Statusorder::create([
            'status'=> 'Prepare'
         ]);

         Subcategorie::create([
            'category_id' => '1',
            'name' => "All Fashion"
         ]);

         Subcategorie::create([
            'category_id' => '1',
            'name' => "Women's fashion"
         ]);

         Subcategorie::create([
            'category_id' => '1',
            'name' => "Men's Fashion"
         ]);

         Subcategorie::create([
            'category_id' => '1',
            'name' => "Shoes"
         ]);

         Subcategorie::create([
            'category_id' => '1',
            'name' => "Accesories"
         ]);

         Subcategorie::create([
            'category_id' => '1',
            'name' => "Outwear"
         ]);

         Subcategorie::create([
            'category_id' => '2',
            'name' => "All Book"
         ]);

         Subcategorie::create([
            'category_id' => '2',
            'name' => "Fictions"
         ]);

         Subcategorie::create([
            'category_id' => '2',
            'name' => "Non-Fictions"
         ]);

         Subcategorie::create([
            'category_id' => '3',
            'name' => "All Electronics"
         ]);

         Subcategorie::create([
            'category_id' => '3',
            'name' => "Mobile Phones"
         ]);

         Subcategorie::create([
            'category_id' => '3',
            'name' => "Laptops & Computers"
         ]);

         Subcategorie::create([
            'category_id' => '3',
            'name' => "Cameras & Photography"
         ]);

         Subcategorie::create([
            'category_id' => '3',
            'name' => "Audio & Headphones"
         ]);

         Subcategorie::create([
            'category_id' => '3',
            'name' => "Accecories"
         ]);

         Subcategorie::create([
            'category_id' => '4',
            'name' => "All Mahallah Equipement"
         ]);

         Subcategorie::create([
            'category_id' => '4',
            'name' => "Kitchen Appliances & Cookware"
         ]);

         Subcategorie::create([
            'category_id' => '4',
            'name' => "Laundry Equipment"
         ]);

         Subcategorie::create([
            'category_id' => '4',
            'name' => "Organizers & Study Aids"
         ]);


         Subcategorie::create([
            'category_id' => '5',
            'name' => "All Cosmetics"
         ]);

         Subcategorie::create([
            'category_id' => '5',
            'name' => "Make-Up"
         ]);

         Subcategorie::create([
            'category_id' => '5',
            'name' => "Skincare"
         ]);

         Subcategorie::create([
            'category_id' => '5',
            'name' => "Haircare"
         ]);

         Subcategorie::create([
            'category_id' => '5',
            'name' => "Perfume"
         ]);

         Subcategorie::create([
            'category_id' => '6',
            'name' => "Health & Wellness"
         ]);

         Subcategorie::create([
            'category_id' => '6',
            'name' => "Arts & Crafts"
         ]);

         Subcategorie::create([
            'category_id' => '6',
            'name' => "Pet Supplies"
         ]);
         
         Subcategorie::create([
            'category_id' => '6',
            'name' => "Others"
         ]);

         Delivery::create([
            'del_option'=> 'Delivery to your mahallah'
         ]);
         
         Delivery::create([
            'del_option'=> 'Pick up at meeting point'
         ]);

         Discussion::create([
            'title'=>'Delivery System',
            'discussion'=> 'It is important to set the maximum days of delivery time',
            'username'=>'1'
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
        
        Product::create([
         'product_pic'=> '/images/H&M.jpg',
         'category_id' => '1',
         'product_name'=> 'H&M Blouse',
         'condition_id' => '1',
         'option_id'=> '1',
         'username'=> '1',
         'product_price' => '30',
         'nego_id'=> '1',
         'brand'=> 'H&M',
         'material'=> 'cotton',
         'more_desc'=> 'Used for 3 months', 
         'meetup_point'=> 'Mahallah Hafsa'
     ]);

     Product::create([
      'product_pic'=> '/images/novelhp.jpg',
      'category_id' => '2',
      'product_name'=> 'Harry Potter Novel',
      'condition_id' => '1',
      'option_id'=> '1',
      'username'=> '1',
      'product_price' => '30',
      'nego_id'=> '1',
      'brand'=> 'Book',
      'material'=> 'Book',
      'more_desc'=> 'Read twice', 
      'meetup_point'=> 'Mahallah Hafsa'
  ]);

    }
}
