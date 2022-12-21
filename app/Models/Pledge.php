<?php

namespace App\Models;

use App\Models\Purpose;
use App\Models\PledgeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pledge extends Model
{
    use HasFactory;
    protected $table= 'pledges';
    protected $fillable = [
        'type_id',
        'user_id',
        'purpose_id',
        'name',
        'amount',
        'description',
        'deadline',
        'status',
        'created_by'
   
    ];

    public function type()
    {
        return $this->belongsTo(PledgeType::class, 'type_id','id');
    }

    // public function purpose()
    // {
    //     return $this->belongsTo(Purpose::class, 'purpose_id','id');
    // }
    // for relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
