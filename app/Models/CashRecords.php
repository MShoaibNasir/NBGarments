<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 👈 Add this

class CashRecords extends Model
{
    use SoftDeletes;
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
    public function investment()
    {
        return $this->belongsTo(Invesment::class, 'primary_id', 'id');
    }
}
