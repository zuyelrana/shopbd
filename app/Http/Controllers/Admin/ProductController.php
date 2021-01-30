<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductAttribute;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'section'])->orderBy('id', 'desc')->get();
        $products = json_decode(json_encode($products));
        //    echo "<pre>";
        //    print_r($products);die;
        return view('backend.product.index', compact('products'));
    }
    public function addEditProduct($id = null)
    {

        $categories = Category::all();
        $sections = Section::all();
        if ($id == "") {
            $title = "Add Prouct";
            $product = "";
            $getCategories = array();
        } else {
            $title = "Edit Prouct";
            $product = Product::find($id);
        }
        //product Filter
        $productFilters=Product::productFilters();
        $FabricArray=$productFilters['FabricArray'];
        $SleeveArray=$productFilters['SleeveArray'];
        $PatternArray=$productFilters['PatternArray'];
        $FitArray=$productFilters['FitArray'];
        $OcassionArray=$productFilters['OcassionArray'];
        // Section with Categories And SubCategories
        $categories = Section::with('categories')->get();
        $categories = json_decode(json_encode($categories));
        $brands=Brand::where('status',1)->get()->toArray();
        return view('backend.product.add_edit_form')->with(compact('title', 'categories', 'sections', 'FabricArray', 'SleeveArray', 'PatternArray', 'FitArray', 'OcassionArray', 'categories', 'product','brands'));
    }

    public function store(Request $request)
    {
        $product = new Product();
        $this->validate($request, [
            'product_name' => 'required|string|unique:products,product_name',
            'product_code' => 'required|string|unique:products,product_code',
            'product_color' => 'required|string',
            'product_price' => 'required|numeric',
            'product_discount' => 'required|numeric',
            'product_weight' => 'required|numeric',
            'main_image' => 'required',
            'wash_care' => 'required|string',
            'meta_title' => 'string',
            'meta_description' => 'string',
            'description' => 'required|string',
            'meta_keywords' => 'string',
            'category_id' => 'required',
            'brand_id' => 'required',
        ]);
        $categoryDeatails = Category::find($request->category_id);
        $product->section_id = $categoryDeatails->section_id;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_color = $request->product_color;
        $product->product_price = $request->product_price;
        $product->product_discount = $request->product_discount;
        $product->product_weight = $request->product_weight;
        $product->description = $request->description;
        $product->wash_care = $request->wash_care;
        $product->fabric = $request->fabric;
        $product->pattern = $request->pattern;
        $product->sleeve = $request->sleeve;
        $product->fit = $request->fit;
        $product->ocassion = $request->ocassion;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        if (empty($request->is_featured)) {
            $product->is_featured = "No";
        } else {
            $product->is_featured = "Yes";
        }


        $product->slug = Str::slug($request->product_name);
        $product->main_image = $this->uploadeImage($request);
        $product->status = true;
        $product->save();

    

        $product->refresh();
        //Product Attribute Price
        $attribute = new ProductAttribute();
        $attribute->product_id = $product->id;
        $attribute->sku = $request->product_code . '-' . "sm";
        $attribute->size = "Small";
        $attribute->price = $request->product_price;
        $attribute->stock = 1;
        $attribute->save();

        toastr()->success('Product Added Succesfully ! now add attribute');
        return redirect()->route('admin.productattribute.addAttribute',$product->id);
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $this->validate($request, [
            'product_name' => "required|string|unique:products,product_name,$id",
            'product_code' => "required|string|unique:products,product_code,$id",
            'product_color' => 'required|string',
            'product_price' => 'required|numeric',
            'product_discount' => 'required|numeric',
            'product_weight' => 'required|numeric',
            'wash_care' => 'required|string',
            'meta_title' => 'string',
            'meta_description' => 'string',
            'description' => 'required|string',
            'meta_keywords' => 'string',
            'brand_id' => 'required',
        ]);
        $categoryDeatails = Category::find($request->category_id);
        $product->section_id = $categoryDeatails->section_id;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->product_color = $request->product_color;
        $product->product_price = $request->product_price;
        $product->product_discount = $request->product_discount;
        $product->product_weight = $request->product_weight;
        $product->description = $request->description;
        $product->wash_care = $request->wash_care;
        $product->fabric = $request->fabric;
        $product->pattern = $request->pattern;
        $product->sleeve = $request->sleeve;
        $product->fit = $request->fit;
        $product->ocassion = $request->ocassion;
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;




        if (empty($request->is_featured)) {
            $product->is_featured = "No";
        } else {
            $product->is_featured = "Yes";
        }
        $product->slug = Str::slug($request->product_name);
        $file = $request->file("main_image");
        if ($file) {
            if (!empty($product->main_image)) {
                if (file_exists("backend/assets/images/product/large/" . $product->main_image)) {
                    unlink("backend/assets/images/product/large/" . $product->main_image);
                }
                if (file_exists("backend/assets/images/product/medium/" . $product->main_image)) {
                    unlink("backend/assets/images/product/medium/" . $product->main_image);
                }
                if (file_exists("backend/assets/images/product/small/" . $product->main_image)) {
                    unlink("backend/assets/images/product/small/" . $product->main_image);
                }
            }
            $product->main_image = $this->uploadeImage($request);
        }
        $product->status = true;
        $product->save();
        toastr()->success('Product Updated Succesfully !');
        return redirect()->route('admin.product.index');
    }



    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = false;
            } else {
                $status = true;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }


    public function destroy($id)
    {

        $product = Product::find($id);
        if (!empty($product->main_image)) {
            if (file_exists("backend/assets/images/product/large/" . $product->main_image)) {
                unlink("backend/assets/images/product/large/" . $product->main_image);
            }
            if (file_exists("backend/assets/images/product/medium/" . $product->main_image)) {
                unlink("backend/assets/images/product/medium/" . $product->main_image);
            }
            if (file_exists("backend/assets/images/product/small/" . $product->main_image)) {
                unlink("backend/assets/images/product/small/" . $product->main_image);
            }
        }
        $product->delete();
        toastr()->success('Product deleted Succesfully');
        return redirect()->route('admin.product.index');
    }

    protected function uploadeImage($request)
    {
        if ($request->hasFile('main_image')) {
            $image_tmp = $request->file('main_image');
            if ($image_tmp->isValid()) {
                // uplode Image
                $imageNewName = date('mdYHis') . uniqid() . $image_tmp->getClientOriginalName();
                $large_image_path = 'backend/assets/images/product/large/' . $imageNewName;
                $medium_image_path = 'backend/assets/images/product/medium/' . $imageNewName;
                $small_image_path = 'backend/assets/images/product/small/' . $imageNewName;
                Image::make($image_tmp)->resize(660,700 )->save($large_image_path);
                Image::make($image_tmp)->resize(580, 652)->save($medium_image_path);
                Image::make($image_tmp)->resize(220, 245)->save($small_image_path);
                return $imageNewName;
            }
        }
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('images'), $fileName);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/' . $fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }
}
