<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function store(Request $request){
            $data=$request->all();
            Customer::create($data);
            return redirect()->back()->with('success','Customer Create Successfully!');
    }
}
