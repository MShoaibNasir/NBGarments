<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 👈 Add this


class DiscountReturn extends Model
{
    use SoftDeletes;
    protected $table = 'discount_return';
    protected $guarded = ['id'];
}
