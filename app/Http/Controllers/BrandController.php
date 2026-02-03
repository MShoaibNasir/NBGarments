<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    // ✅ List all brand
    public function index()
    {
        checkAuthentication();
        $brand = Brand::all();
        return view('dashboard.brand.index', compact('brand'));
    }

    // ✅ Show create form
    public function create()
    {
        checkAuthentication();
        return view('dashboard.brand.create');
    }

    // ✅ Store new brand
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brand,name',
            'link' => 'required|url|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('logos'), $filename);
            $imagePath = 'logos/' . $filename;
            $validated['logo']=$filename;
        }
       Brand::create($validated);

        return redirect()->route('brand.list')->with('success', 'Brand added successfully!');
    }

    // ✅ Show edit form
    public function edit($id)
    {
        checkAuthentication();
        $brand = Brand::findOrFail($id);
        return view('dashboard.brand.edit', compact('brand'));
    }

    // ✅ Update brand
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brand,name,' . $id,
            'link' => 'required|url|max:255',
            'logo' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            
        ]);

        $brand = Brand::findOrFail($id);
         if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('logos'), $filename);
            $imagePath = 'logos/' . $filename;
            $validated['logo']=$filename;
        }
        $brand->update($validated);

        return redirect()->route('brand.list')->with('success', 'Brand updated successfully!');
    }

    // ✅ Delete brand
    public function delete($id)
    {
        $brand = Brand::findOrFail($id);

        $brandCount = \DB::table('invoices')->where('brand_id', $brand->id)->count();

        if ($brandCount > 0) {
            return redirect()->back()->with('error', 'Cannot delete this brand because it is assigned to invoices.');
        }
        $brand->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully!');
    }
}
