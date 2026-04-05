<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\SupplierData;
use Auth;

class SupplierController extends Controller
{
    public function index()
    {
        checkAuthentication();
        $customer = Customer::where('user_id', Auth::user()->id)->where('status', 'supplier')->get();
        return view('dashboard.supplier.index', compact('customer'));
    }
    public function create(Request $request)
    {
        $supplier = Customer::where('user_id', Auth::user()->id)->where('status', 'supplier')->get();
        return view('dashboard.supplier.create', compact('supplier'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bill_no' => 'required',
            'supplier_id' => 'required',
            'amount' => 'required',
            'description' => 'required',
            'supplier_date' => 'required',
            'status'=>'required'

        ]);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        SupplierData::create($data);
        return redirect()->route('supplier.list')->with('success', 'Data Add Successfully!');
    }



    public function filter(Request $request, $id)
    {
        checkAuthentication();
        return view('dashboard.supplier.filter', ['id' => $id]);
    }




    public function list(Request $request)
    {
        // ✅ Get inputs with defaults
        $page = (int) ($request->get('ayis_page') ?? 1);
        $qty = (int) ($request->get('qty') ?? 10);

        $first_name = $request->get('first_name');
        $bill_no = $request->get('bill_no');
        $product_name = $request->get('product_name');
        $sorting = $request->get('sorting');
        $order = $request->get('direction');

        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');

        $custom_pagination_path = '';

        // ✅ Base Query (apply filters ONCE)
        $baseQuery = SupplierData::where('user_id', Auth::id())
            ->where('supplier_id', $request->customer_id);

        // ✅ Filters
        if ($first_name) {
            $baseQuery->whereHas('customer', function ($q) use ($first_name) {
                $q->where('name', 'like', '%' . $first_name . '%');
            });
        }

        if ($product_name) {
            $baseQuery->whereHas('product', function ($q) use ($product_name) {
                $q->where('name', 'like', '%' . $product_name . '%');
            });
        }

        if ($start_date && $end_date) {
            $baseQuery->whereBetween('supplier_date', [
                $start_date . ' 00:00:00',
                $end_date . ' 23:59:59'
            ]);
        } elseif ($start_date) {
            $baseQuery->where('supplier_date', '>=', $start_date . ' 00:00:00');
        } elseif ($end_date) {
            $baseQuery->where('supplier_date', '<=', $end_date . ' 23:59:59');
        }

        if ($bill_no) {
            $baseQuery->where('cheque_no', 'like', '%' . $bill_no . '%');
        }

        // ✅ Clone queries
        $invoice = clone $baseQuery;
        $previousRecordsQuery = clone $baseQuery;

        // ✅ Sorting (MUST be same)
        if ($sorting && $order) {
            $invoice->orderBy($sorting, $order);
            $previousRecordsQuery->orderBy($sorting, $order);
        } else {
            $invoice->orderBy('created_at', 'asc');
            $previousRecordsQuery->orderBy('created_at', 'asc');
        }

        // ✅ Calculate offset
        $offset = ($page - 1) * $qty;

        // ✅ Get previous records (for opening balance)
        $previousRecords = $previousRecordsQuery
            ->take($offset)
            ->get();

        // ✅ Opening Balance Calculation
        $openingBalance = 0;

        foreach ($previousRecords as $item) {
            if ($item->status == 'Purchasing') {
                $openingBalance += $item->amount;
            } elseif ($item->status == 'Discount') {
                $openingBalance -= $item->amount;
            } else {
                $openingBalance -= $item->amount;
            }
        }

        // ✅ Pagination
        $data = $invoice->paginate($qty, ['*'], 'page', $page)
            ->setPath($custom_pagination_path);

        // ✅ Other data
        $customer_name = Customer::where('id', $request->customer_id)
            ->select('name')
            ->first();

        $total_sell_amount = number_format($data->sum('amount'));

        // ✅ Return view
        return view('dashboard.supplier.list', compact(
            'data',
            'total_sell_amount',
            'customer_name',
            'openingBalance'
        ))->render();
    }
}
