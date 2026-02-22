<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expenses;
use Auth;
use App\Models\Customer;
use App\Models\Product;
use App\Models\CashRecords;
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
        $customer = Customer::where('user_id', Auth::user()->id)->get();
        $product = Product::where('user_id', Auth::user()->id)->get();
        $expenses = Expenses::where('user_id', Auth::user()->id)->get();
        return view('dashboard.expenses.create', ['expenses' => $expenses, 'customer' => $customer, 'product' => $product]);
    }
    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'description' => 'required|string|max:255',
    //         'amount' => 'required',
    //         'refrence' => 'required',


    //     ]);
    //     $data = $request->all();
    //     $data['user_id'] = Auth::user()->id;
    //     $expenses=Expenses::create($data);


    //         CashRecords::create([
    //             'table_name'  => 'expenses',
    //             'primary_id'  => $expenses->id,
    //             'user_id'     => Auth::id(),
    //             'customer_id' => null,
    //         ]);

    //     return redirect()->route('expenses.filter')->with('success', 'expenses Create Successfully!');
    // }


    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'amount'      => 'required|numeric|min:1',
            'refrence'   => 'required|string|max:255',
        ]);

        // Add user_id safely
        $validated['user_id'] = Auth::id();

        // Use transaction because inserting in 2 tables
        DB::beginTransaction();

        try {
            // Create Expense
            $expenses = Expenses::create($validated);

            // Create Cash Record
            CashRecords::create([
                'table_name'  => 'expenses',
                'primary_id'  => $expenses->id,
                'user_id'     => Auth::id(),
                'customer_id' => null,
            ]);

            DB::commit();

            return redirect()
                ->route('expenses.filter')
                ->with('success', 'Expense created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Something went wrong!');
        }
    }



    public function edit($id)
    {
        checkAuthentication();
        $expenses = expenses::findOrFail($id);
        return view('dashboard.expenses.edit', compact('expenses', 'customer'));
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
            'expenses_no' => 'required|string|max:255',
            'customer_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'total_amount' => 'required'

        ]);
        $brand = Expenses::findOrFail($id);
        $brand->update($validated);
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

        $invoice = Expenses::where('user_id', Auth::id());
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
        $total_sell_amount = number_format($data->sum('amount'));
        //  $jsondata = json_encode($selected_data);

        return view('dashboard.expenses.list', compact('data', 'total_sell_amount'))->render();
    }

    public function filter(Request $request)
    {

        checkAuthentication();
        return view('dashboard.expenses.filter');
    }
}
