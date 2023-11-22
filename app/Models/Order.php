<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['username', 'product_id', 'order_date','total_price', 'paymentoption_id','paymentstatus_id','productstatus_id'];

      public function user()
      {
          return $this->belongsTo(User::class,'username');
      }

      public function paymentstatus()
      {
          return $this->belongsTo(Statuspayment::class,'paymentstatus_id');
      }
      
      public function paymentoption()
      {
          return $this->belongsTo(Payment::class,'paymentoption_id');
      }

      public function productstatus()
      {
          return $this->belongsTo(Statusproduct::class,'productstatus_id');
      }
}
