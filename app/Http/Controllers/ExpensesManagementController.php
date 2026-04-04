<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use Auth;
use App\Models\Customer;
use App\Models\Product;
use App\Models\CashRecords;
use App\Models\SupplierData;
use DB;

class ExpensesManagementController extends Controller
{
    public function index()
    {
        checkAuthentication();
        $bill = Expenses::where('user_id', Auth::user()->id)->get();
        return view('dashboard.expenses.index', compact('expenses'));
    }

    public function create()
    {
        checkAuthentication();
        $supplier = Customer::where('user_id', Auth::user()->id)->where('status', 'supplier')->get();
        return view('dashboard.expenses.create', ['supplier' => $supplier]);
    }



    // public function store(Request $request)
    // {
    //     // Validation
    //     $validated = $request->validate([
    //         'description' => 'required|string|max:255',
    //         'amount'      => 'required|numeric|min:1',
    //         'date' => 'required',
    //         'payment_type' => 'required',
    //     ]);

    //     // Add user_id safely
    //     $data = $request->all();
    //     $data['user_id'] = Auth::id();


    //     // Use transaction because inserting in 2 tables
    //     DB::beginTransaction();

    //     try {

    //         // Create Expense
    //         $validated['user_id'] = Auth::user()->id;
    //         if ($request->payment_type == 'Payment') {


    //             $expenses = Expenses::create($validated);

    //             if (isset($request->supplier_id) && $request->supplier_id != '') {
    //                 $data = $request->all();
    //                 $data['user_id'] = Auth::user()->id;
    //                 $data['expenses_id'] = $expenses->id;
    //                 $data['status'] = 'Payment';
    //                 $data['supplier_date'] = $request->date;
    //                 SupplierData::create($data);
    //             }
    //             // Create Cash Record
    //             CashRecords::create([
    //                 'table_name'  => 'expenses',
    //                 'primary_id'  => $expenses->id,
    //                 'user_id'     => Auth::id(),
    //                 'customer_id' => null,
    //                 'date' => $request->date
    //             ]);
    //         } else {


    //             $expenses = Expenses::create($validated);

    //             if (isset($request->supplier_id) && $request->supplier_id != '') {
    //                 $data = $request->all();
    //                 $data['user_id'] = Auth::user()->id;
    //                 $data['expenses_id'] = $expenses->id;
    //                 $data['status'] = 'Discount';
    //                 $data['supplier_date'] = $request->date;
    //                 SupplierData::create($data);
    //             }
    //         }

    //         DB::commit();

    //         return redirect()
    //             ->route('expenses.filter')
    //             ->with('success', 'Expense created successfully!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();

    //         return back()->with('error', 'Something went wrong!');
    //     }
    // }
    public function store(Request $request)
    {
        // ✅ Validation
        $validated = $request->validate([
            'description'  => 'required|string|max:255',
            'amount'       => 'required|numeric|min:1',
            'date'         => 'required|date',
            'payment_type' => 'required|in:Payment,Discount',
            'supplier_id'  => 'required',
        ]);

        // ✅ Add logged-in user
        $validated['user_id'] = Auth::id();

        DB::beginTransaction();

        try {

            // ✅ Create Expense
            $expense = Expenses::create($validated);

            // ✅ If supplier exists, insert SupplierData
            if (!empty($validated['supplier_id'])) {
                SupplierData::create([
                    'supplier_id'   => $validated['supplier_id'],
                    'expenses_id'   => $expense->id,
                    'user_id'       => Auth::id(),
                    'status'        => $validated['payment_type'],
                    'supplier_date' => $validated['date'],
                    'description'=>$validated['description'],
                    'amount'=>$validated['amount']
                    
                ]);
            }

            // ✅ Only for Payment type → create Cash Record
            if ($validated['payment_type'] === 'Payment') {
                CashRecords::create([
                    'table_name'  => 'expenses',
                    'primary_id'  => $expense->id,
                    'user_id'     => Auth::id(),
                    'customer_id' => null,
                    'date'        => $validated['date'],
                ]);
            }

            DB::commit();

            return redirect()
                ->route('expenses.filter')
                ->with('success', 'Expense created successfully!');
        } catch (\Exception $e) {

            DB::rollBack();

            // ✅ Log error for debugging
            \Log::error('Expense Store Error: ' . $e->getMessage());

            return back()
                ->withInput()
                ->with('error', 'Something went wrong!');
        }
    }



    public function edit($id)
    {
        checkAuthentication();
        $expenses = Expenses::with('SupplierData')->findOrFail($id);
        $supplier = Customer::where('user_id', Auth::user()->id)->where('status', 'supplier')->get();
        return view('dashboard.expenses.edit', compact('expenses', 'supplier'));
    }
    public function delete($id)
    {
        $customers = Expenses::findOrFail($id);

        $customers->delete();
        return redirect()->back()->with('success', 'expenses deleted successfully!');
    }
    // ✅ Update brand
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount'      => 'required|numeric|min:1',
            'date' => 'required'

        ]);
        $brand = Expenses::findOrFail($id);
        $brand->update($validated);


        SupplierData::where('expenses_id', $id)->update([
            'amount' => $request->amount,
            'description' => $request->description,
            'supplier_id' => $request->supplier_id,
            'supplier_date' => $request->date
        ]);
        return redirect()->route('expenses.filter')->with('success', 'expenses updated successfully!');
    }



    public function list(Request $request)
    {
        $page = $request->get('ayis_page');
        $qty = $request->get('qty');
        $status = $request->get('status');
        $custom_pagination_path = '';

        $first_name = $request->get('first_name');
        $expenses_no = $request->get('bill_no');
        $product_name = $request->get('product_name');
        $sorting = $request->get('sorting');
        $order = $request->get('direction');

        $invoice = Expenses::where('user_id', Auth::id())->where('payment_type','Payment');
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
            $invoice->whereBetween('date', [
                $start_date . ' 00:00:00',
                $end_date . ' 23:59:59'
            ]);
        } elseif ($start_date) {
            $invoice->where('date', '>=', $start_date . ' 00:00:00');
        } elseif ($end_date) {
            $invoice->where('date', '<=', $end_date . ' 23:59:59');
        }

        // if ($bill_no) {
        //     $invoice->where('bill_no', 'like', '%' . $bill_no . '%');
        // }

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


        $total_sell_amount = Expenses::where('user_id', Auth::id())->where('payment_type','Payment')
            ->whereNotNull('amount')
            ->sum('amount');
        $total_sell_amount = number_format($total_sell_amount);
        //  $jsondata = json_encode($selected_data);

        return view('dashboard.expenses.list', compact('data', 'total_sell_amount'))->render();
    }

    public function filter(Request $request)
    {

        checkAuthentication();
        return view('dashboard.expenses.filter');
    }
}
