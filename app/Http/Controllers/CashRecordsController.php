<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\Ledger;
use App\Models\CashRecords;
use Auth;

class CashRecordsController extends Controller
{
    public function filter(Request $request)
    {
        checkAuthentication();
        return view('dashboard.cashRecords.filter');
    }




    public function list(Request $request)
    {
        // ✅ Defaults
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

        // ✅ Base Query (apply filters once)
        $baseQuery = CashRecords::where('user_id', Auth::id());

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
            $baseQuery->whereBetween('date', [
                $start_date . ' 00:00:00',
                $end_date . ' 23:59:59'
            ]);
        } elseif ($start_date) {
            $baseQuery->where('date', '>=', $start_date . ' 00:00:00');
        } elseif ($end_date) {
            $baseQuery->where('date', '<=', $end_date . ' 23:59:59');
        }

        if ($bill_no) {
            $baseQuery->where('cheque_no', 'like', '%' . $bill_no . '%');
        }

        // ✅ Clone queries
        $invoice = clone $baseQuery;
        $previousRecordsQuery = clone $baseQuery;

        // ✅ Sorting (same for both)
        if ($sorting && $order) {
            //$invoice->orderBy($sorting, $order);
            $invoice->orderBy('date', 'asc');
            $previousRecordsQuery->orderBy('date', 'asc');
        } else {
            $invoice->orderBy('date', 'asc');
            $previousRecordsQuery->orderBy('date', 'asc');
        }

        // ✅ Offset
        $offset = ($page - 1) * $qty;

        // ✅ Previous records for opening balance
        $previousRecords = $previousRecordsQuery
            ->take($offset)
            ->get();
       

        // ✅ Opening Balance Calculation
        $openingBalance = 0;

        foreach ($previousRecords as $item) {            
            if ($item->table_name == 'Payment') {
                $openingBalance += $item->paymnent->amount ?? 0;
            } else {
                $openingBalance -= $item->expenses->amount ?? 0;
            }
        }

        // ✅ Pagination
        $data = $invoice->paginate($qty, ['*'], 'page', $page)
            ->setPath($custom_pagination_path);

        $total_sell_amount = number_format($data->sum('amount'));

      
        // ✅ Return view
        return view('dashboard.cashRecords.index', compact(
            'data',
            'openingBalance',
            'total_sell_amount'
        ))->render();
    }
}
