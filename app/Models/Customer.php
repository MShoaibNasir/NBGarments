<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 👈 Add this


class Customer extends Model
{
    use SoftDeletes;
    protected $table = 'customers';
    protected $guarded = ['id'];
}
