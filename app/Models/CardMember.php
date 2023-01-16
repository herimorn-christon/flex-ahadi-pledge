<?php

namespace App\Models;

use App\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class CardMember extends Model implements Auditable
{
    use AuditableTrait;
    protected $table= 'cards_members';
    protected $fillable = [
        'user_id',
        'card_no',
        'status'
   
    ];

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_no','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

           // for formatted date 
           public function getFormattedDateAttribute()
           {
               return $this->created_at->format('d-m-Y');
           }
           
           protected $appends = ['formattedDate'];
}
