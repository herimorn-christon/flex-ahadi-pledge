<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function purposes()
    {
        return $this->hasMany(Purpose::class);
    }

    public function communities()
    {
        return $this->hasMany(Jumuiya::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function payments()
{
    return $this->hasMany(Payment::class);
}

//the model for the announcemnets
public function announcements()
{
    return $this->hasMany(Announcement::class);
}
}
