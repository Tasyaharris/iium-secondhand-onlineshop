<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAdmin extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function replies()
{
    return $this->hasMany(Response::class, 'parent_id');
}

public function responses()
{
    return $this->hasMany(Response::class, 'parent_id');
}
}
