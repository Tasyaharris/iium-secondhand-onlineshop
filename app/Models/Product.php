<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //protected $fillable = ['username'];
    protected $fillable = ['category_id','product_name','condition_id', 'option_id', 'product_price', 'nego_id', 'brand','material', 'meetup_point', 'username'];

}
