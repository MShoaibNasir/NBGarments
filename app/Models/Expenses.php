<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 👈 Add this


class Expenses extends Model
{
    use SoftDeletes;
    protected $table='expenses';
    protected $guarded=['id'];
}
