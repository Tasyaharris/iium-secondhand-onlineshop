<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

      public function user()
      {
          return $this->belongsTo(User::class,'username');
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

      public function cancelitem()
    {
         return $this->hasMany(CancelItem::class);
    }
}
