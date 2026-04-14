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
        $customers = Customer::where('status', 'customer')->get();
        return view('dashboard.cashRecords.filter')->with(['customers' => $customers]);
    }




    public function list(Request $request)
    {
        $page = (int) ($request->get('ayis_page') ?? 1);
        $qty = (int) ($request->get('qty') ?? 10);

        $first_name = $request->get('first_name');
        $bill_no = $request->get('bill_no');
        $amount = $request->get('amount');
        $product_name = $request->get('product_name');
        $sorting = $request->get('sorting');
        $order = $request->get('direction');

        $start_date = $request->get('start_date');
        $end_date = $request->get('end_date');
        $purpose = $request->get('purpose');
        $customer_id = $request->get('customer_id');

        $baseQuery = CashRecords::where('user_id', Auth::id());

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
        if ($amount) {
            $baseQuery->where(function ($query) use ($amount) {

                // Payment
                $query->whereHas('paymnent', function ($q) use ($amount) {
                    $q->where('amount', $amount);
                });

                // Expenses
                $query->orWhereHas('expenses', function ($q) use ($amount) {
                    $q->where('amount',$amount);
                });

                // Investment
                $query->orWhereHas('investment', function ($q) use ($amount) {
                    $q->where('amount',$amount);
                });
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

        if ($customer_id) {
            $baseQuery->where('customer_id', $customer_id);
        }

        if ($purpose) {
            $baseQuery->where('table_name', $purpose);
        }

        $invoiceQuery = clone $baseQuery;
        $previousRecordsQuery = clone $baseQuery;

        $invoiceQuery->orderBy('date', 'asc');
        $previousRecordsQuery->orderBy('date', 'asc');

        $offset = ($page - 1) * $qty;

        $previousRecords = $previousRecordsQuery
            ->take($offset)
            ->get();

        $openingBalance = 0;

        foreach ($previousRecords as $item) {
            if ($item->table_name == 'Payment') {
                $openingBalance += $item->paymnent->amount ?? 0;
            } elseif ($item->table_name == 'expenses') {
                $openingBalance -= $item->expenses->amount ?? 0;
            } else {
                $openingBalance += $item->investment->amount ?? 0;
            }
        }

        $data = $invoiceQuery->paginate($qty, ['*'], 'page', $page);

        $total_sell_amount = 0;

        $allRecords = (clone $baseQuery)->get();

        foreach ($allRecords as $item) {
            if ($item->table_name == 'Payment') {
                $total_sell_amount += $item->paymnent->amount ?? 0;
            } elseif ($item->table_name == 'expenses') {
                $total_sell_amount -= $item->expenses->amount ?? 0;
            } else {
                $total_sell_amount += $item->investment->amount ?? 0;
            }
        }

        $total_sell_amount = number_format($total_sell_amount);

        return view('dashboard.cashRecords.index', compact(
            'data',
            'openingBalance',
            'total_sell_amount'
        ))->render();
    }
}
