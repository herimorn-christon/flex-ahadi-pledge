<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Jumuiya extends Model implements Auditable
{
    use AuditableTrait;
    protected $table= 'jumuiya';

    protected $fillable=[
        'name',
        'location',
        'abbreviation'
       
 
    ];

    public function user(){
        return $this->hasMany(User::class,'jumuiya','id');
    }

 
}
