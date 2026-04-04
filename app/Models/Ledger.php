<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ledger extends Model
{
    protected $table = 'ledger';
    protected $guarded = ['id'];

    public function paymnent()
    {
        return $this->belongsTo(Payment::class, 'primary_id', 'id');
    }
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'primary_id', 'id');
    }
    public function discount()
    {
        return $this->belongsTo(Discount::class, 'primary_id', 'id')->where('discount_type', 'payment_discount');
    }
}
