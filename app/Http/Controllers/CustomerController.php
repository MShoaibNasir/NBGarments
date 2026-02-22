<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Auth;

class CustomerController extends Controller
{
    public function index()
    {
        checkAuthentication();
        $customer = Customer::where('user_id', Auth::user()->id)->get();
        return view('dashboard.customer.index', compact('customer'));
    }   

    public function create()
    {
        checkAuthentication();
        return view('dashboard.customer.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'max:255'

        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Customer::create($data);
        return redirect()->route('customer.list')->with('success', 'Customer Create Successfully!');
    }
    public function edit($id)
    {
        checkAuthentication();
        $customer = Customer::findOrFail($id);
        return view('dashboard.customer.edit', compact('customer'));
    }
    public function delete($id)
    {
        $customers = Customer::findOrFail($id);
        $customers->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully!');
    }
    // ✅ Update brand
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'max:255'

        ]);
        $brand = Customer::findOrFail($id);
        $brand->update($validated);
        return redirect()->route('customer.list')->with('success', 'Customer updated successfully!');
    }



    // public function list(Request $request)
    // {
    //     $page = $request->get('ayis_page');
    //     $qty = $request->get('qty');
    //     $status = $request->get('status');
    //     $custom_pagination_path = '';

    //     $first_name = $request->get('first_name');
    //     $last_name = $request->get('last_name');
    //     $email = $request->get('email');
    //     $sorting = $request->get('sorting');
    //     $order = $request->get('direction');

    //     // ✅ If Admin → show all invoices. Else show only logged-in user invoices.
    //     $invoice = Auth::user()->hasRole('Admin')
    //         ? Invoice::query()
    //         : Invoice::where('user_id', Auth::id());

    //     // ✅ Filters
    //     if ($first_name) {
    //         $invoice->where('first_name', 'like', '%' . $first_name . '%');
    //     }

    //     if ($status && $status != "Select Status") {
    //         $invoice->where('status', $status);
    //     }

    //     if ($last_name) {
    //         $invoice->where('last_name', 'like', '%' . $last_name . '%');
    //     }

    //     if ($email) {
    //         $invoice->where('email_address', 'like', '%' . $email . '%');
    //     }

    //     // ✅ Sorting
    //     if ($sorting && $order) {
    //         $invoice->orderBy($sorting, $order);
    //     }

    //     // ✅ Build exportable data
    //     $i = 1;
    //     $selected_data = $invoice->get()->map(function ($item) use (&$i) {
    //         return [
    //             'S No'        => $i++,
    //             'Time'        => $item->created_at->format('d-m-Y H:i:s'),
    //             'First Name'  => ucfirst($item->first_name),
    //             'Last Name'   => ucfirst($item->last_name),
    //             'Email'       => $item->email_address,
    //             'Phone No'    => $item->phone_number,
    //             'Address'     => $item->address,
    //             'Amount'      => number_format($item->invoiceAmount->total_amount ?? 0, 2),
    //             'URL'         => $item->url,
    //             'Brand'       => $item->brand->link ?? null
    //         ];
    //     })->toArray(); // ✅ convert to array for Excel

    //     // ✅ Pagination
    //     $data = $invoice->paginate($qty, ['*'], 'page', $page)
    //         ->setPath($custom_pagination_path);

    //     $jsondata = json_encode($selected_data);

    //     return view('dashboard.customer.list', compact('data', 'jsondata'))->render();
    // }

    // public function filter(Request $request,$id)
    // {
        
    //     checkAuthentication();
    //     return view('dashboard.customer.filter');
    // }
}
