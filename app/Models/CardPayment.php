<?php

namespace App\Models;

use App\Models\User;
use App\Models\CardMember;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class CardPayment extends Model
{
    // use HasFactory;
    protected $table= 'card_payments';
    protected $fillable = [
        'card_member',
        'amount',
        'created_by',
   
    ];

    public function card()
    {
        return $this->belongsTo(CardMember::class, 'card_member','id');
    }
    
    // for relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }

       // for formatted date 
       public function getFormattedDateAttribute()
       {
           return $this->created_at->format('d-m-Y');
       }
       
       protected $appends = ['formattedDate'];
}
