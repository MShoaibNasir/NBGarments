<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCost extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'product_cost';
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
}
