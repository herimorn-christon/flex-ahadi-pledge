<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Notification extends Model implements Auditable
{
    use AuditableTrait;
    protected $table= 'notifications';
    protected $fillable = [
        'type',
        'user_id',
        'message',
        'created_by'
   
    ];
}
