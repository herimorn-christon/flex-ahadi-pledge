<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatives extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'date_of_birth',
        'relation'
    ];


    public function user()
       {
           return $this->belongsTo(User::class, 'users','id');
       }
}
