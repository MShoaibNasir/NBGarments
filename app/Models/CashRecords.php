<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CashRecords extends Model
{
    protected $table = 'cash_records';
    protected $guarded = ['id'];

    public function paymnent()
    {
        return $this->belongsTo(Payment::class, 'primary_id', 'id');
    }
    public function expenses()
    {
        return $this->belongsTo(Expenses::class, 'primary_id', 'id');
    }
  
}
