<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Invoice;
use App\Models\Brand;
use Illuminate\Support\Facades\Cache;


if (!function_exists('checkAuthentication')) {
    function checkAuthentication()
    {  
        if (!Auth::check()) {
            return Redirect::route('show.login')->send();
        } 
    }
}


if (!function_exists('countInvoices')) {
    function countInvoices($brand_id) {
        return Invoice::where('brand_id', $brand_id)->count();
    }
}

if (!function_exists('totalInvoiceAmount')) {
    function totalInvoiceAmount($brand_id) {
        $cacheKey = "total_invoice_amount_{$brand_id}";

        return Cache::remember($cacheKey, now()->addMinutes(10), function() use ($brand_id) {
            return Invoice::where('brand_id', $brand_id)
                ->with('invoiceAmount') 
                ->get()
                ->sum(function($invoice) {
                    return $invoice->invoiceAmount ? $invoice->invoiceAmount->total_amount : 0;
                });
        });
    }
}
if (!function_exists('totalInvoiceAmountRecieved')) {
    function totalInvoiceAmountRecieved($brand_id) {
        $cacheKey = "total_invoice_amount_recieved_{$brand_id}";

        return Cache::remember($cacheKey, now()->addMinutes(10), function() use ($brand_id) {
            return Invoice::where('brand_id', $brand_id)
                 ->where('status','Completed')
                ->with('invoiceAmount') 
                ->get()
                ->sum(function($invoice) {
                    return $invoice->invoiceAmount ? $invoice->invoiceAmount->total_amount : 0;
                });
        });
    }
}

if (!function_exists('current_brand')) {
    function current_brand($brand_id)
{
    //$host = request()->getHost();
    return Brand::where('id', $brand_id)->first();
}
}
