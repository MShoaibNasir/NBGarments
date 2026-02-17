<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Auth;
use Illuminate\Http\RedirectResponse;

class BankController extends Controller
{
   
  
    public function index(): View
    {
        $bank = Bank::latest()->get();
        return view('dashboard.bank.index', compact('bank'));
    }

    
    public function create()
    {
        
        return view('dashboard.bank.create');
    }

 
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'name' => 'required'
        ]);
        $data=$request->all();
        $data['user_id']=Auth::user()->id;
        Bank::create($data);

        return redirect()->route('bank.list')
            ->with('success', 'Banl created successfully.');
    }

    
    public function show(Bank $bank): View
    {
        return view('dashboard.bank.show', compact('bank'));
    }

    
    public function edit(Bank $bank): View
    {
   
        return view('dashboard.bank.edit', compact('bank'));
    }

    public function update(Request $request, Bank $bank)
    {
        request()->validate([
            'name' => 'required'
        ]);
      

        $bank->update($request->all());

        return redirect()->route('bank.list')
            ->with('success', 'Bank updated successfully');
    }

   
    public function DELETE(Bank $bank)
    {
     
        $bank->delete();

        return redirect()->route('bank.list')
            ->with('success', 'Bank deleted successfully');
    }
}
