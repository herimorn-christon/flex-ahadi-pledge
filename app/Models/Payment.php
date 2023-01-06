<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;

class Payment extends Model implements Auditable
{
    use AuditableTrait;
    protected $table= 'payments';
    protected $fillable = [
        'type_id',
        'user_id',
        'pledge_id',
        'amount',
        'created_by'
   
    ];

    public function payment()
    {
        return $this->belongsTo(PaymentType::class, 'type_id','id');
    }
    public function purpose()
    {
        return $this->belongsTo(Purpose::class, 'pledge_id','id');
    }

    public function payer()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    // for relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }
}
