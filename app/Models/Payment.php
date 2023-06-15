<?php

namespace App\Models;

use App\Models\Pledge;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model implements Auditable
{
    use AuditableTrait;
    protected $table= 'payments';
    // protected $fillable = [
    //     'type_id',
    //     'user_id',
    //     'pledge_id',
    //     'amount',
    //     'created_by',
    //     'verified',
    //     'receipt'
   
    // ];

    public function payment()
    {
        return $this->belongsTo(PaymentType::class, 'type_id','id');
    }
    public function pledge()
    {
        return $this->belongsTo(Pledge::class, 'pledge_id','id');
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

    // for formatted date 
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }
    
    protected $appends = ['formattedDate'];
}
