<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
      protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */

      public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }
      public function ProductCost()
    {
        return $this->hasMany(ProductCost::class, 'product_id', 'id');
    }
}
