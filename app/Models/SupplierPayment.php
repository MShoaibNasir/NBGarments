<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
      protected $table = 'supplier_payment';
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
}
