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

        $page = $request->get('ayis_page');
        $qty = $request->get('qty');
        $status = $request->get('status');
        $custom_pagination_path = '';

        $first_name = $request->get('first_name');
        $bill_no = $request->get('bill_no');
        $product_name = $request->get('product_name');
        $sorting = $request->get('sorting');
        $order = $request->get('direction');

        $invoice = CashRecords::where('user_id', Auth::id());
        //$customer_name=Customer::where('id',$request->customer_id)->select('name')->first();

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
            $invoice->where('cheque_no', 'like', '%' . $bill_no . '%');
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
        $total_sell_amount = number_format($data->sum('amount'));
        //  $jsondata = json_encode($selected_data);
       

        return view('dashboard.cashRecords.index', compact('data'))->render();
    }
}
