<?php

namespace App\Http\Controllers;

use App\Models\ProductCost;
use App\Models\Product;
use Illuminate\Http\Request;

use Auth;

class ProductCostController extends Controller
{
    public function saveProduct(Request $request)
    {
        try {

            //return $request->all();

            // ✅ Save data
            $productCost = new ProductCost();
            $productCost->description = $request->description;
            $productCost->amount = $request->amount;
            $productCost->product_id = $request->product_id;
            $productCost->user_id = Auth::id();
            $productCost->save();


            $productCostData = ProductCost::where('product_id', $request->product_id)->sum('amount');
            Product::where('id', $request->product_id)->update(['amount' => $productCostData]);


            // ✅ Success response (for AJAX)
            return response()->json([
                'status' => true,
                'message' => 'Product cost saved successfully'
            ]);
        } catch (\Exception $e) {

            // ❌ Error handling
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage() // remove in production if needed
            ], 500);
        }
    }
    public function listProduct(Request $request)
    {

        $data = ProductCost::where('product_id', $request->product_id)->get();
        return view('products.list', ['data' => $data]);
    }


    public function delete(Request $request, $id)
    {
        $data = ProductCost::where('id', $id)->delete();
        return redirect()->back()->with('success','Delete Successfully!');

    }
}
