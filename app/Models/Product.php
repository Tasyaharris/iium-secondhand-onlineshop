<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //protected $fillable = ['username'];
    protected $fillable = ['product_pic','category_id','product_name','condition_id', 'option_id', 'product_price', 'nego_id', 'brand','material', 'meetup_point', 'username'];

     // Relationship with Condition model
     public function condition()
     {
         return $this->belongsTo(Condition::class, 'condition_id');
     }
 
     // Relationship with NegoOption model
     public function nego()
     {
         return $this->belongsTo(Nego::class, 'nego_id');
     }

     public function user()
     {
         return $this->belongsTo(User::class,'username');
     }
}
