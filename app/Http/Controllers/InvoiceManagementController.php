<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Package;
use App\Models\InvoiceAmount;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;
use DB;

class InvoiceManagementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:invoice-list|invoice-create|invoice-edit|invoice-delete', ['only' => ['index', 'filter']]);
        $this->middleware('permission:invoice-create', ['only' => ['createInvoice', 'storeInvoice']]);
        $this->middleware('permission:invoice-edit', ['only' => ['editInvoice', 'updateInvoice']]);
        $this->middleware('permission:invoice-delete', ['only' => ['destroyInvoice']]);
    }

    public function createInvoice(Request $request)
    {
        checkAuthentication();
        $brand=Brand::get();
        return view('dashboard.invoice.create',['brand'=>$brand]);
    }
    public function storeInvoice(Request $request)
{
    checkAuthentication();

$rules = [
    'first_name'            => 'required|string|max:255',
    'last_name'             => 'required|string|max:255',
    'email'                 => 'required|email|max:255',
    'phone'                 => 'required|string|max:20',
    'zipcode'               => 'required|string|max:20',
    'address'               => 'required|string|max:500',
    'packages_description'  => 'required|array|min:1',
    'packages_amount'       => 'required|array|min:1',
    'total_amount'          => 'required|numeric|gt:0',
    'brand_id'              => 'required',
    'currency'              => 'required',
];

$messages = [
    'first_name.required'           => 'Please enter your first name.',
    'first_name.string'             => 'First name must contain only letters.',
    'first_name.max'                => 'First name cannot exceed 255 characters.',

    'last_name.required'            => 'Please enter your last name.',
    'last_name.string'              => 'Last name must contain only letters.',
    'last_name.max'                 => 'Last name cannot exceed 255 characters.',

    'email.required'                => 'Please provide your email address.',
    'email.email'                   => 'Please enter a valid email address.',
    'email.max'                     => 'Email address cannot exceed 255 characters.',

    'phone.required'                => 'Please enter your phone number.',
    'phone.string'                  => 'Phone number format is invalid.',
    'phone.max'                     => 'Phone number cannot exceed 20 characters.',

    'zipcode.required'              => 'Please enter your ZIP code.',
    'zipcode.string'                => 'ZIP code format is invalid.',
    'zipcode.max'                   => 'ZIP code cannot exceed 20 characters.',

    'address.required'              => 'Please enter your complete address.',
    'address.string'                => 'Address format is invalid.',
    'address.max'                   => 'Address cannot exceed 500 characters.',

    'packages_description.required' => 'Please select at least one package description.',
    'packages_description.array'    => 'Package description must be a valid list.',
    'packages_description.min'      => 'You must provide at least one package description.',

    'packages_amount.required'      => 'Please enter at least one package amount.',
    'packages_amount.array'         => 'Package amount must be a valid list.',
    'packages_amount.min'           => 'You must provide at least one package amount.',

    'total_amount.required'         => 'Please enter the total amount.',
    'total_amount.numeric'          => 'Total amount must be a number.',
    'total_amount.gt'               => 'Total amount must be greater than zero.',

    'brand_id.required'             => 'Please select a brand.',
    'currency.required'             => 'Please select a currency.',
];

$validator = Validator::make($request->all(), $rules, $messages);

if ($validator->fails()) {
    return redirect()->back()->withErrors($validator)->withInput();
}


    DB::beginTransaction();

    try {
        $invoice = new Invoice;
        $invoice->first_name = $request->first_name;
        $invoice->last_name = $request->last_name;
        $invoice->email_address = $request->email;
        $invoice->phone_number = $request->phone;
        $invoice->zip_code = $request->zipcode;
        $invoice->secrete_id = 'I-' . random_int(100000, 999999);
        $invoice->address = $request->address;
        $invoice->brand_id = $request->brand_id;
        $invoice->user_id = Auth::user()->id;
        $invoice->save();

        foreach ($request->packages_description as $key => $data) {
            $package = new Package;
            $package->description = $data;
            $package->amount = $request->packages_amount[$key];
            $package->invoice_id = $invoice->id;
            $package->save();
        }

        $ivoice_amount = new InvoiceAmount;
        $ivoice_amount->balance_amount = $request->balance_amount ?? 0;
        $ivoice_amount->discount = $request->discount ?? 0;
        $ivoice_amount->tax = $request->tax ?? 0;
        $ivoice_amount->total_amount = $request->total_amount;
        $ivoice_amount->currency = $request->currency;
        $ivoice_amount->invoice_id = $invoice->id;
        $ivoice_amount->save();

        // ✅ Create a dynamic PayPal payment link
        $brand_name=Brand::where('id',$request->brand_id)->select('name','link')->first();
        //dump($brand_name->link);
        //dump($invoice->secrete_id);
        //$paypalUrl = route('paypal.show', ['brand_link'=>$brand_name->link,'id' => $invoice->secrete_id]);
        $paypalUrl = route(
            'paypal.show',
            [
                'brand_link' => $brand_name->link,
                'id' => $invoice->secrete_id
            ],
            false // 👈 THIS removes domain
        );
        
        
        //dd($paypalUrl);
        $invoice->url = $paypalUrl;
        $invoice->save();

        DB::commit();

        return redirect()->route('invoice.filter')
                         ->with('success', 'Invoice created successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Something went wrong while creating the invoice: ' . $e->getMessage());
    }
}


public function index(Request $request)
{
    $page = $request->get('ayis_page');
    $qty = $request->get('qty');
    $status = $request->get('status');
    $custom_pagination_path = '';

    $first_name = $request->get('first_name');
    $last_name = $request->get('last_name');
    $email = $request->get('email');
    $sorting = $request->get('sorting');
    $order = $request->get('direction');

    // ✅ If Admin → show all invoices. Else show only logged-in user invoices.
    $invoice = Auth::user()->hasRole('Admin')
        ? Invoice::query()
        : Invoice::where('user_id', Auth::id());

    // ✅ Filters
    if ($first_name) {
        $invoice->where('first_name', 'like', '%' . $first_name . '%');
    }

    if ($status && $status != "Select Status") {
        $invoice->where('status', $status);
    }

    if ($last_name) {
        $invoice->where('last_name', 'like', '%' . $last_name . '%');
    }

    if ($email) {
        $invoice->where('email_address', 'like', '%' . $email . '%');
    }

    // ✅ Sorting
    if ($sorting && $order) {
        $invoice->orderBy($sorting, $order);
    }

    // ✅ Build exportable data
    $i = 1;
    $selected_data = $invoice->get()->map(function ($item) use (&$i) {
        return [
            'S No'        => $i++,
            'Time'        => $item->created_at->format('d-m-Y H:i:s'),
            'First Name'  => ucfirst($item->first_name),
            'Last Name'   => ucfirst($item->last_name),
            'Email'       => $item->email_address,
            'Phone No'    => $item->phone_number,
            'Address'     => $item->address,
            'Amount'      => number_format($item->invoiceAmount->total_amount ?? 0, 2),
            'URL'         => $item->url,
            'Brand'       => $item->brand->link ?? null
        ];
    })->toArray(); // ✅ convert to array for Excel

    // ✅ Pagination
    $data = $invoice->paginate($qty, ['*'], 'page', $page)
                    ->setPath($custom_pagination_path);

    $jsondata = json_encode($selected_data);

    return view('dashboard.invoice.list', compact('data', 'jsondata'))->render();
}

    public function filter(Request $request)
    {
        checkAuthentication();
        return view('dashboard.invoice.filter');
    }
    public function exportInvoice(Request $request) 
    {
        $data = $request->json_data;
        $data = json_decode($data, true);
        //dd($data);
        return  Excel::download(new InvoiceExport($data), 'invoice_list_'.date('YmdHis').'.xlsx');
    }
    
    public function delete(Request $request,$id){
        checkAuthentication();
        Invoice::where('id',$id)->delete();
        return redirect()->back()
                         ->with('success', 'Invoice delete successfully!');
    }
    public function edit(Request $request,$id){
        checkAuthentication();
        $invoice=Invoice::with('packages')->where('id',$id)->first();
        
        $brand=Brand::get();
        return view('dashboard.invoice.edit',['invoice'=>$invoice,'brand'=>$brand]);
    }
    public function update(Request $request, $id)
{
    checkAuthentication();

    // ✅ Validation rules
    $rules = [
        'first_name'            => 'required|string|max:255',
        'last_name'             => 'required|string|max:255',
        'email_address'                 => 'required|email|max:255',
        'phone_number'                 => 'required|string|max:20',
        'zip_code'               => 'required|string|max:20',
        'address'               => 'required|string|max:500',
        'packages_description'  => 'required|array|min:1',
        'packages_amount'       => 'required|array|min:1',
        'total_amount'          => 'required|numeric|gt:0',
        'brand_id'              => 'required',
        'currency'              => 'required',
    ];

    // ✅ Custom validation messages
    $messages = [
        'first_name.required'           => 'Please enter your first name.',
        'first_name.string'             => 'First name must contain only letters.',
        'first_name.max'                => 'First name cannot exceed 255 characters.',

        'last_name.required'            => 'Please enter your last name.',
        'last_name.string'              => 'Last name must contain only letters.',
        'last_name.max'                 => 'Last name cannot exceed 255 characters.',

        'email.required'                => 'Please provide your email address.',
        'email.email'                   => 'Please enter a valid email address.',
        'email.max'                     => 'Email address cannot exceed 255 characters.',

        'phone.required'                => 'Please enter your phone number.',
        'phone.string'                  => 'Phone number format is invalid.',
        'phone.max'                     => 'Phone number cannot exceed 20 characters.',

        'zipcode.required'              => 'Please enter your ZIP code.',
        'zipcode.string'                => 'ZIP code format is invalid.',
        'zipcode.max'                   => 'ZIP code cannot exceed 20 characters.',

        'address.required'              => 'Please enter your complete address.',
        'address.string'                => 'Address format is invalid.',
        'address.max'                   => 'Address cannot exceed 500 characters.',

        'packages_description.required' => 'Please select at least one package description.',
        'packages_description.array'    => 'Package description must be a valid list.',
        'packages_description.min'      => 'You must provide at least one package description.',

        'packages_amount.required'      => 'Please enter at least one package amount.',
        'packages_amount.array'         => 'Package amount must be a valid list.',
        'packages_amount.min'           => 'You must provide at least one package amount.',

        'total_amount.required'         => 'Please enter the total amount.',
        'total_amount.numeric'          => 'Total amount must be a number.',
        'total_amount.gt'               => 'Total amount must be greater than zero.',

        'brand_id.required'             => 'Please select a brand.',
        'currency.required'             => 'Please select a currency.',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::beginTransaction();

    try {
        $invoice = Invoice::findOrFail($id);

        // ✅ Update main invoice details
        $invoice->first_name = $request->first_name;
        $invoice->last_name = $request->last_name;
        $invoice->email_address = $request->email_address;
        $invoice->phone_number = $request->phone_number;
        $invoice->zip_code = $request->zip_code;
        $invoice->address = $request->address;
        $invoice->brand_id = $request->brand_id;
        $invoice->save();

        // ✅ Delete old packages & re-insert
        Package::where('invoice_id', $invoice->id)->delete();

        foreach ($request->packages_description as $key => $desc) {
            $package = new Package;
            $package->description = $desc;
            $package->amount = $request->packages_amount[$key];
            $package->invoice_id = $invoice->id;
            $package->save();
        }

        // ✅ Update or create invoice amount
        $invoice_amount = InvoiceAmount::updateOrCreate(
            ['invoice_id' => $invoice->id],
            [
                'balance_amount' => $request->balance_amount ?? 0,
                'discount'       => $request->discount ?? 0,
                'tax'            => $request->tax ?? 0,
                'total_amount'   => $request->total_amount,
                'currency'       => $request->currency,
            ]
        );

        // ✅ Update PayPal link
        $brand = Brand::select('name')->find($request->brand_id);
        $paypalUrl = route('paypal.show', [
            'brand_name' => str_replace(' ', '_', $brand->name),
            'id'         => $invoice->secrete_id
        ]);

        $invoice->url = $paypalUrl;
        $invoice->save();

        DB::commit();

        return redirect()->route('invoice.filter')
                         ->with('success', 'Invoice updated successfully!');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Something went wrong while updating the invoice: ' . $e->getMessage());
    }
}

}
