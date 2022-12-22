<?php

namespace App\Models;

use App\Models\Card;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CardMember extends Model
{
    use HasFactory;
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
}
