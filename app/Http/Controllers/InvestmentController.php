<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Invesment;
use App\Models\Ledger;
use App\Models\CashRecords;
use Illuminate\Http\RedirectResponse;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;

class InvestmentController extends Controller
{

    public function create()
    {
        $customers = Customer::where('user_id', Auth::user()->id)->where('status', 'customer')->get();
        return view('dashboard.investments.create', compact('customers'));
    }

    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required',
            'amount' => 'required',
            'description' => 'required'
        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $invesments = Invesment::create($data);
        CashRecords::create([
            'table_name'  => 'invesments',
            'primary_id'  => $invesments->id,
            'user_id'     => Auth::id()
        ]);

        return redirect()->route('investment.list')->with('success', 'Investment Data created successfully.');
    }

    public function index()
    {
        $data = Invesment::where('user_id', Auth::user()->id)->get();
        return view('dashboard.investments.index', compact('data'));
    }
    public function edit($id)
    {
        $data = Invesment::where('id', $id)->first();
        return view('dashboard.investments.edit', compact('data'));
    }
    public function update(Request $request, $id)
    {
        request()->validate([
            'name' => 'required',
            'amount' => 'required',
            'description' => 'required'
        ]);
        $data = $request->except('_token');
        $invesments = Invesment::where('id', $id)->update($data);
        return redirect()->route('investment.list')->with('success', 'Investment Data Update successfully.');
    }

    public function delete($id)
    {
        $data = Invesment::where('id', $id)->delete();
        CashRecords::where('table_name', 'invesments')->where('primary_id', $id)->delete();
        return Redirect()->back()->with('success','Data Delete Successfully!');
    }
}
