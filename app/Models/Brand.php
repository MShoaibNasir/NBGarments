<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $guarded = ['id'];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'brand_id', 'id');
    }
}
