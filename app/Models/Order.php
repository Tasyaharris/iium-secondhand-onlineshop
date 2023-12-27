<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Order extends Model
{
    use HasFactory;
    use Notifiable;
    
    protected $primaryKey = 'id'; // Make sure this matches your actual primary key column name.

    protected $fillable = [
        'totalOrder',
        'paymentoption_id',
        'delivery_id',
        'del_place',
        'username', // Make sure 'username' is included here
        'order_date',
        'paymentProof',
        'paymentstatus_id',
        'orderstatus_id',
    ];
    //protected $guarded=[''];
      public function user()
      {
          return $this->belongsTo(User::class,'username');
      }

      public function product()
      {
          return $this->belongsTo(Product::class,'product_id');
      }

      public function paymentstatus()
      {
          return $this->belongsTo(Statuspayment::class,'paymentstatus_id');
      }
      
      public function payment()
      {
          return $this->belongsTo(Payment::class,'paymentoption_id');
      }

      public function productstatus()
      {
          return $this->belongsTo(Statusproduct::class,'productstatus_id');
      }

      public function orderstatus()
      {
          return $this->belongsTo(Statusorder::class,'orderstatus_id');
      }

      public function orderItems()
    {
         return $this->hasMany(OrderItem::class);
    }

    public function delivery()
    {
         return $this->belongsTo(Delivery::class);
    }
}