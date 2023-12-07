<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancelItem extends Model
{
    use HasFactory;
    protected $guarded=[''];
    public function cancelorder()
    {
        return $this->belongsTo(CancelOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
