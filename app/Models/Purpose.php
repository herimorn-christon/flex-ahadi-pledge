<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_start',
        'status',
        'created_by'
   
    ];


    // for relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }
    public function church()
    {
        return $this->belongsTo(Church::class);
    }
    //this purpouse belongs to the church
    public function pledges()
    {
        return $this->hasMany(Pledge::class);
    }
}
