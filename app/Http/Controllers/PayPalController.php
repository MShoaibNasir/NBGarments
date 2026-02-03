<?php
namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function show($invoice_id) {
        $host = request()->getHost();
        dd($host);
        $invoice=Invoice::where('secrete_id',$invoice_id)->first();
        $brand_link=$invoice->brand->link;
        return view('paypal.checkout',['invoice'=>$invoice]); // blade with PayPal button
    }

    public function createPayment(Request $request)
    {
        $total_amount = $request->total_amount;
        $currency = $request->currency;
        $invoice_id = $request->secrete_id;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setAccessToken($provider->getAccessToken());
        
    
        $order = [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $currency,
                        "value" => $total_amount
                    ]
                ]
            ],
            "application_context" => [
                "return_url" => route('paypal.success',[$invoice_id]),
                "cancel_url" => route('paypal.cancel',[$invoice_id]),
            ]
        ];
    
        $response = $provider->createOrder($order);
        
    
        if (isset($response['id'])) {
            // Redirect user to approval URL
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect($link['href']);
                }
            }
    
            return back()->with('error', 'Approval URL not found.');
        } else {
            return back()->with('error', 'Create order failed.');
        }
    }
    
    public function checkoutDummy($brand_name=null,$invoice_id){
         $clientId=env('PAYPAL_SANDBOX_CLIENT_ID');
         $invoice=Invoice::where('secrete_id',$invoice_id)->first();
        return view("paypal.checkoutDummy",['invoice'=>$invoice,'clientId'=>$clientId]);
    } 



    public function success(Request $request,$invoice_id)
    {
       
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        $orderId = $request->query('token'); // PayPal returns token param for orders
        $capture = $provider->capturePaymentOrder($orderId);
        // $invoice_id='I-993758';
        Invoice::where('secrete_id',$invoice_id)->update(['status'=>'Completed']);
        $invoice=Invoice::where('secrete_id',$invoice_id)->first();
        // store $capture details in DB and show success
        return view('paypal.success',['invoice'=>$invoice]);
    }

    public function cancel(Request $request,$invoice_id) {
        Invoice::where('secrete_id',$invoice_id)->update(['status'=>'Failed']);
        $invoice=Invoice::where('secrete_id',$invoice_id)->first();
        return view('paypal.error',['invoice'=>$invoice]);
    }
    public function createOrder(Request $request)
{
    $amount = $request->amount;

    $response = Http::withBasicAuth(env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET'))
        ->post("https://api-m.paypal.com/v2/checkout/orders", [
            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ]
                ]
            ]
        ]);

    return response()->json([
        'orderID' => $response['id']
    ]);
}

public function captureOrder(Request $request)
{
    $orderId = $request->order_id;

    $response = Http::withBasicAuth(env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET'))
        ->post("https://api-m.paypal.com/v2/checkout/orders/{$orderId}/capture");

    // ✅ Save payment in database
    Payment::create([
        'invoice_id' => $request->invoice_id,
        'paypal_order_id' => $orderId,
        'status' => 'success',
        'amount' => $response['purchase_units'][0]['payments']['captures'][0]['amount']['value']
    ]);

    return response()->json(['status' => 'success']);
}


}
