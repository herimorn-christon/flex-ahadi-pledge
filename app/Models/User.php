<?php

namespace App\Models;

use App\Models\Jumuiya;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table= 'users';
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'profile_picture',
        'date_of_birth',
        'gender',
        'fcm_token',
        'phone',
        'disabled',
        'email',
        'role_id',
        'jumuiya',
        'password',
        'status',
        
    ];

      /**
     * Specifies the user's FCM token
     *
     * @return string|array
     */
    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

       // for relationship
       public function community()
       {
           return $this->belongsTo(Jumuiya::class, 'jumuiya','id');
       }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
