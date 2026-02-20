<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use Auth;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Ledger;
use DB;

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
        return view('dashboard.bill.create', ['bill' => $bill, 'customer' => $customer, 'product' => $product]);
    }
    public function store(Request $request)
    {
        // Strong validation
        $validated = $request->validate([
            'bill_no'      => 'required|string|max:255',
            'customer_id'  => 'required|exists:customers,id',
            'qty'          => 'required|numeric|min:1',
            'price'        => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {

            // Create Bill
            $bill = Bill::create([
                'bill_no'      => $request->bill_no,
                'customer_id'  => $request->customer_id,
                'qty'          => $request->qty,
                'price'        => $request->price,
                'total_amount' => $request->total_amount,
                'product_id' => $request->product_id,
                'user_id'      => Auth::id(),
            ]);

            // Create Ledger Entry
            Ledger::create([
                'table_name'  => 'bill',
                'primary_id'  => $bill->id,
                'user_id'     => Auth::id(),
                'customer_id' => $request->customer_id,
            ]);

            DB::commit();

            return redirect()
                ->route('bill.filter')
                ->with('success', 'Bill Created Successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Something went wrong!');
        }
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
        return redirect()->route('bill.filter')->with('success', 'Bill updated successfully!');
    }



    public function list(Request $request)
    {
        $page = $request->get('ayis_page');
        $qty = $request->get('qty');
        $status = $request->get('status');
        $custom_pagination_path = '';

        $first_name = $request->get('first_name');
        $bill_no = $request->get('bill_no');
        $product_name = $request->get('product_name');
        $sorting = $request->get('sorting');
        $order = $request->get('direction');

        $invoice = Bill::where('user_id', Auth::id());
        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        // ✅ Filters
        if ($first_name) {
            $invoice->whereHas('customer', function ($q) use ($first_name) {
                $q->where('name', 'like', '%' . $first_name . '%');
            });
        }
        if ($product_name) {
            $invoice->whereHas('product', function ($q) use ($product_name) {
                $q->where('name', 'like', '%' . $product_name . '%');
            });
        }


        if ($start_date && $end_date) {
            $invoice->whereBetween('created_at', [
                $start_date . ' 00:00:00',
                $end_date . ' 23:59:59'
            ]);
        } elseif ($start_date) {
            $invoice->where('created_at', '>=', $start_date . ' 00:00:00');
        } elseif ($end_date) {
            $invoice->where('created_at', '<=', $end_date . ' 23:59:59');
        }

        if ($bill_no) {
            $invoice->where('bill_no', 'like', '%' . $bill_no . '%');
        }

        // ✅ Sorting
        if ($sorting && $order) {
            $invoice->orderBy($sorting, $order);
        }

        // ✅ Build exportable data
        $i = 1;
        // $selected_data = $invoice->get()->map(function ($item) use (&$i) {
        //     return [
        //         'S No'        => $i++,
        //         'Time'        => $item->created_at->format('d-m-Y H:i:s'),
        //         'First Name'  => ucfirst($item->first_name),
        //         'Last Name'   => ucfirst($item->last_name),
        //         'Email'       => $item->email_address,
        //         'Phone No'    => $item->phone_number,
        //         'Address'     => $item->address,
        //         'Amount'      => number_format($item->invoiceAmount->total_amount ?? 0, 2),
        //         'URL'         => $item->url,
        //         'Brand'       => $item->brand->link ?? null
        //     ];
        // })->toArray(); // ✅ convert to array for Excel

        // ✅ Pagination
        $data = $invoice->paginate($qty, ['*'], 'page', $page)
            ->setPath($custom_pagination_path);
        $total_sell_amount = number_format($data->sum('total_amount'));
        //  $jsondata = json_encode($selected_data);

        return view('dashboard.bill.list', compact('data', 'total_sell_amount'))->render();
    }

    public function filter(Request $request)
    {

        checkAuthentication();
        return view('dashboard.bill.filter');
    }
}
