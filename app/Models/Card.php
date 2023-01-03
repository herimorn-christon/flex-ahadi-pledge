<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Card extends Model implements Auditable
{
    use AuditableTrait;

    protected $table= 'cards';
    protected $fillable = [
        'card_no',
        'status',
        'created_by'
    ];



}
