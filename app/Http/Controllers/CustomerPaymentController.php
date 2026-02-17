<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerPaymentController extends Controller
{

    public function create()
    {
        return view('dashboard.payment.create');
    }
    public function filter()
    {
        return view('dashboard.payment.filter');
    }
}
