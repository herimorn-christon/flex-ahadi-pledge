<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;
    protected $table= 'announcements';
    protected $fillable = [
        'title',
        'body',
        'file',
    ];


              // for formatted date 
              public function getFormattedDateAttribute()
              {
                  return $this->created_at->format('D d-M-Y');
              }
              
              protected $appends = ['formattedDate'];

}
