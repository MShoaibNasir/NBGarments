<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;

class SupplierController extends Controller
{
        public function index()
    {
        checkAuthentication();
        $customer = Customer::where('user_id', Auth::user()->id)->where('status','Supplier')->get();
        return view('dashboard.supplier.index', compact('customer'));
    }
}
