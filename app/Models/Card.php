<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Card extends Model
{
    use HasFactory;

    protected $table= 'cards';
    protected $fillable = [
        'card_no',
        'status',
        'created_by'
    ];



}
