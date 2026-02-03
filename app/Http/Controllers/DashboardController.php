<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Brand;
use App\Models\Invoice;

class DashboardController extends Controller
{



    public function index()
    {
    
        if (!Auth::check()) {
            redirect()->route('show.login')->send();
        }
        $brand = Brand::with('invoice')->get();
        $users_count=User::count();
        $employees_count = User::role('Employee')->count();
        $invoices_count = Invoice::count();
        return view('dashboard.main',['users_count'=>$users_count,'employees_count'=>$employees_count,'invoices_count'=>$invoices_count,'brand'=>$brand]);
    }
}
