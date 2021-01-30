<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use PhpParser\JsonDecoder;

class ProductAttributeController extends Controller
{
    public function addAttribute(Request $request, $id)
    {

        $product = Product::with('attributes')->find($id);
        $productdata = json_decode(json_encode($product), true);
        if ($request->isMethod('post')) {

            //    $data = $request->all();
            foreach ($request->price as $key => $value) {
                if (!empty($value)) {
                    $attributeProduct = ProductAttribute::where(['product_id' => $id, 'size' => $request->size[$key]])->count();
                    if ($attributeProduct > 0) {
                        toastr()->error($request->size[$key] . '' . ' Size attribut for ' . $product['product_name'] . 'already been taken');
                        return back();
                    }
                    $attribute = new ProductAttribute();
                    $attribute->product_id = $id;
                    $sku = json_encode($request->size[$key]);
                    $sub = substr($sku, 1, 2);
                    $attribute->sku = $product->product_code . '-' . $sub;
                    $attribute->size = $request->size[$key];
                    $attribute->price = $value;
                    $attribute->stock = $request->stock[$key];
                    $attribute->save();
                }
            }
            toastr()->success('Attribute created Succesfully');
            return back();
        }
        return view('backend.product.attribute.addAttribute', compact('product', 'productdata'));
    }
    public function updateAttribute(Request $request, $id)
    {
        foreach ($request->price as $key => $value) {
            if (!empty($value)) {
                $attribute = ProductAttribute::find($request->attribute_id[$key]);
                $attribute->price = $value;
                $attribute->product_id = $id;
                $attribute->stock = $request->stock[$key];
                $attribute->save();
            }
        }
        toastr()->success('Attribute updated Succesfully');
        return back();
    }

    public function published(ProductAttribute $attribute)
    {
        $attribute->update([
            'status' => 1,
        ]);
        toastr()->success('Attribute published Succesfully');
        return back();
    }
    public function unpublished(ProductAttribute $attribute)
    {
        $attribute->update([
            'status' => 0,
        ]);
        toastr()->success('Attribute unpublished Succesfully');
        return back();
    }
}
