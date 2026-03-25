<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 👈 Add this


class Invesment extends Model
{
    use SoftDeletes;
    protected $table = 'invesments';
    protected $guarded = ['id'];

    // public function paymnent()
    // {
    //     return $this->belongsTo(Payment::class, 'primary_id', 'id');
    // }
    // public function bill()
    // {
    //     return $this->belongsTo(Bill::class, 'primary_id', 'id');
    // }

}
