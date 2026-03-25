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
        $users_count=User::count();
        return view('dashboard.main',['users_count'=>$users_count]);
    }
}
