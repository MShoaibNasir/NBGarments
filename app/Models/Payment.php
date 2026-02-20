<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 👈 Add this

class Payment extends Model
{
    use SoftDeletes;
    protected $table = 'customer_payments';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
