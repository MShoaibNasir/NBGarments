<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Ledger;
use Auth;
use DB;

class CustomerPaymentController extends Controller
{

    public function create()
    {
        $customers = Customer::where('user_id', Auth::user()->id)->get();
        $banks = Bank::where('user_id', Auth::user()->id)->get();
        return view('dashboard.payment.create', compact('customers', 'banks'));
    }


    public function store(Request $request)
    {
        // Strong validation
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount'      => 'required|numeric|min:1',
            'reference'   => 'nullable|string|max:255',
            'description' => 'nullable|string',

            // If cheque checked then required
            'bank_id'   => 'required_if:is_cheque,1|nullable|exists:banks,id',
            'cheque_no' => 'required_if:is_cheque,1|nullable|string|max:100',
        ]);

        DB::beginTransaction();

        try {

            // Prepare data safely
            $data = [
                'customer_id' => $request->customer_id,
                'amount'      => $request->amount,
                'reference'   => $request->reference,
                'description' => $request->description,
                'user_id'     => Auth::id(),
                'is_cheque'   => $request->has('is_cheque') ? 1 : 0,
                'bank_id'     => $request->bank_id,
                'cheque_no'   => $request->cheque_no,
            ];

            // If not cheque → remove cheque data
            if ($data['is_cheque'] == 0) {
                $data['bank_id'] = null;
                $data['cheque_no'] = null;
            }

            // Create Payment
            $payment = Payment::create($data);

            Ledger::create([
                'table_name'  => 'Payment',
                'primary_id'  => $payment->id,
                'user_id'     => Auth::id(),
                'customer_id' => $request->customer_id,
            ]);
            DB::commit();

            return redirect()
                ->route('payment.filter')
                ->with('success', 'Payment added successfully');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        checkAuthentication();
        $payment = Payment::findOrFail($id);
        $customers = Customer::where('user_id', Auth::user()->id)->get();
        $banks = Bank::where('user_id', Auth::user()->id)->get();
        return view('dashboard.custoner_payment.edit', compact('payment', 'customers', 'banks'));
    }
    public function update(Request $request, $id)
    {
        // Find payment
        $payment = Payment::findOrFail($id);

        // Validation
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount'      => 'required|numeric|min:1',
            'reference'   => 'nullable|string|max:255',

            // If cheque checked then required
            'bank_id'   => 'required_if:is_cheque,1|nullable|exists:banks,id',
            'cheque_no' => 'required_if:is_cheque,1|nullable|string|max:100',
        ]);

        // Get all data
        $data = $request->all();

        // If cheque unchecked → remove cheque data
        if (!$request->has('is_cheque')) {
            $data['is_cheque'] = 0;
            $data['bank_id'] = null;
            $data['cheque_no'] = null;
        }

        // Update payment
        $payment->update($data);

        return redirect()
            ->route('payment.filter')
            ->with('success', 'Payment updated successfully');
    }




    public function filter(Request $request)
    {
        checkAuthentication();
        return view('dashboard.custoner_payment.filter');
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

        $invoice = Payment::where('user_id', Auth::id());
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

        return view('dashboard.custoner_payment.list', compact('data', 'total_sell_amount'))->render();
    }


    public function delete($id)
    {
        $customers = Payment::findOrFail($id);
        $customers->delete();
        return redirect()->back()->with('success', 'Payment deleted successfully!');
    }
}
