<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    public function addProductImage(Request $request, $id)
    {

        $product = Product::with('images')->find($id);
        if ($request->isMethod('post')) {

            $data = $request->all();
            if ($request->hasFile('name')) {
                $names = $request->file('name');
                foreach ($names as $key => $name) {
                    $productImage = new ProductImage();
                    $image_tmp = Image::make($name);

                    // New Name
                    $imageNewName = date('mdYHis') . uniqid() . $name->getClientOriginalName();

                    $large_image_path = 'backend/assets/images/product/large/' . $imageNewName;
                    $medium_image_path = 'backend/assets/images/product/medium/' . $imageNewName;
                    $small_image_path = 'backend/assets/images/product/small/' . $imageNewName;
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(580, 652)->save($medium_image_path);
                    Image::make($image_tmp)->resize(220, 245)->save($small_image_path);
                    $productImage->name = $imageNewName;
                    $productImage->product_id = $id;
                    $productImage->save();
                }
                toastr()->success('Product Images uploded  Succesfully !');
                return back();
            }
        }
        return view('backend.product.addimages.addImages', compact('product'));
    }
    public function published(ProductImage $productImage)
    {
        $productImage->update([
            'status' => true,
        ]);
        toastr()->success('ProductImage published Succesfully');
        return back();
    }
    public function unpublished(ProductImage $productImage)
    {
        $productImage->update([
            'status' => false,
        ]);
        toastr()->success('ProductImage unpublished Succesfully');
        return back();
    }
    public function destroy(ProductImage $productImage)
    {

        if (!empty($productImage->name)) {
            if (file_exists("backend/assets/images/product/large/" . $productImage->name)) {
                unlink("backend/assets/images/product/large/" . $productImage->name);
            }
            if (file_exists("backend/assets/images/product/medium/" . $productImage->name)) {
                unlink("backend/assets/images/product/medium/" . $productImage->name);
            }
            if (file_exists("backend/assets/images/product/small/" . $productImage->name)) {
                unlink("backend/assets/images/product/small/" . $productImage->name);
            }
        }
        $productImage->delete();
        toastr()->success('ProductImage deleted Succesfully');
        return back();
    }
}
