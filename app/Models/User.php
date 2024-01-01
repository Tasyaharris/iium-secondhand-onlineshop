<?php

namespace App\Models;
use App\traits\GenUid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable 
{

    use HasApiTokens, HasFactory, Notifiable;
    //use HasApiTokens;
    //use HasFactory;
    use HasProfilePhoto;
    //use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'id';
    //public $incrementing = false;
protected $keyType = 'string';
    protected $fillable = [
        'username',
        'phone_number',
        'email',
        'password',
       
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    
    public function products()
    {
        return $this->hasMany(Product::class,'username', 'id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class,'id','user_id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id','username');
    // }

    public function messages(){
        return $this->hasMany(Message::class);
    }


    public function canJoinRoom($roomId){

        $granted = false;

        $room = Room::findOrFail($roomId);
        $users = explode(":", $room->users);
        //dd($users);
        foreach($users as $id){
            if($this->id == $id){
                $granted = true;
            } 
        }
        return $granted;
    }

}



