<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // 👈 Add this

  
class Invoice extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $table='invoices';
    protected $guarded=['id'];
    public function invoiceAmount()
{
    return $this->hasOne(InvoiceAmount::class, 'invoice_id', 'id');
}
    protected function brand()
{
    return $this->belongsTo(Brand::class, 'brand_id', 'id');
}
    public  function packages()
{
    return $this->hasMany(Package::class, 'invoice_id', 'id');
}


}
