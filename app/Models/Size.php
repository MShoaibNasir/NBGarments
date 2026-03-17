<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
      protected $table = 'size';
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
}
