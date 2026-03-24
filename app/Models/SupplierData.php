<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierData extends Model
{
  use HasFactory;
  protected $guarded = ['id'];
  protected $table = 'supplier_data';
  /**
   * The attributes that are mass assignable.
   *	
   * @var array
   */
  public function customer()
  {
    return $this->belongsTo(Customer::class, 'supplier_id', 'id');
  }
  public function user()
  {
    return $this->belongsTo(User::class, 'user_id', 'id');
  }
}
