<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'pledge_id'
    ];


    public function pledge()
    {
        return $this->belongsTo(Pledge::class);
    }
}
