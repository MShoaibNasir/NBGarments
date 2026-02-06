<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Auth;
use App\Models\Customer;
use App\Models\Product;

class BillManagementController extends Controller
{
    public function index()
    {
        checkAuthentication();
        $bill = Bill::where('user_id', Auth::user()->id)->get();
        return view('dashboard.bill.index', compact('bill'));
    }

    public function create()
    {
        checkAuthentication();
        $customer = Customer::where('user_id', Auth::user()->id)->get();
        $product = Product::where('user_id', Auth::user()->id)->get();
        $bill = Bill::where('user_id', Auth::user()->id)->get();
        return view('dashboard.bill.create', ['bill' => $bill, 'customer' => $customer,'product'=>$product]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bill_no' => 'required|string|max:255',
            'customer_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'total_amount' => 'required'

        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        Bill::create($data);
        return redirect()->route('bill.list')->with('success', 'Bill Create Successfully!');
    }
    public function edit($id)
    {
        checkAuthentication();
        $bill = Bill::findOrFail($id);
        $customer = Customer::where('user_id', Auth::user()->id)->get();
        return view('dashboard.bill.edit', compact('bill', 'customer'));
    }
    public function delete($id)
    {
        $customers = Bill::findOrFail($id);
        $customers->delete();
        return redirect()->back()->with('success', 'Bill deleted successfully!');
    }
    // ✅ Update brand
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bill_no' => 'required|string|max:255',
            'customer_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'total_amount' => 'required'

        ]);
        $brand = Bill::findOrFail($id);
        $brand->update($validated);
        return redirect()->route('bill.list')->with('success', 'Bill updated successfully!');
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
