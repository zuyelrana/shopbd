<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('backend.brand.index', compact('brands'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:brands',
        ]);
        Brand::create([
            'name' => $request->name,
        ]);
        toastr()->success('Brand created Succesfully');
        return redirect()->route("admin.brand.index");
    }



    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => "required|string|unique:brands,name,$request->id",
        ]);
        $brand = Brand::findOrFail($request->id);
        $brand->update([
            'name' => $request->name,
        ]);

        toastr()->success('Brand updated Succesfully');
        return redirect()->route("admin.brand.index");
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        toastr()->success('Brand deleted Succesfully');
        return redirect()->route("admin.brand.index");
    }
    public function published(Brand $brand)
    {
        $brand->update([
            'status' => true,
        ]);
        toastr()->success('Brand published Succesfully');
        return redirect()->route("admin.brand.index");
    }
    public function unpublished(Brand $brand)
    {
        $brand->update([
            'status' => false,
        ]);
        toastr()->success('Brand unpublished Succesfully');
        return redirect()->route("admin.brand.index");
    }
}
