<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

class ProductListingController extends Controller
{
    public function index($url, Request $request)
    {

        if ($request->ajax()) {
            $data = $request->all();
            //   echo "<pre>";print_r($data);die;
            $url = $data['url'];
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);

                // If  Fabric filter option 
                if (isset($data['fabric']) && !empty($data['fabric'])) {
                    $categoryProducts->whereIn('products.fabric', $data['fabric']);
                }

                // If  Sleeve filter option 
                if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $categoryProducts->whereIn('products.sleeve', $data['sleeve']);
                }

                // If  pattern filter option 
                if (isset($data['pattern']) && !empty($data['pattern'])) {
                    $categoryProducts->whereIn('products.pattern', $data['pattern']);
                }

                // If  Fit filter option 
                if (isset($data['fit']) && !empty($data['fit'])) {
                    $categoryProducts->whereIn('products.fit', $data['fit']);
                }

                // If  Ocassion filter option 
                if (isset($data['ocassion']) && !empty($data['ocassion'])) {
                    $categoryProducts->whereIn('products.ocassion', $data['ocassion']);
                }
                // Sort product
                if (isset($data['sort']) && !empty($data['sort'])) {
                    if ($data['sort'] == "product_latest") {
                        $categoryProducts->orderBy('id', 'desc');
                    } else if ($data['sort'] == "product_name_a_to_z") {
                        $categoryProducts->orderBy('product_name', 'Asc');
                    } else if ($data['sort'] == "product_name_z_to_a") {
                        $categoryProducts->orderBy('product_name', 'desc');
                    } else if ($data['sort'] == "price_low") {
                        $categoryProducts->orderBy('product_price', 'Asc');
                    } else if ($data['sort'] == "price_high") {
                        $categoryProducts->orderBy('product_price', 'desc');
                    } else {
                        $categoryProducts->orderBy('id', 'desc');
                    }
                }
                $categoryProducts = $categoryProducts->paginate(30);
                return view('frontend.listing.ajax_products')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            }
        } else {
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                $categoryProducts = $categoryProducts->paginate(30);

                //product Filter
                $productFilters = Product::productFilters();
                $FabricArray = $productFilters['FabricArray'];
                $SleeveArray = $productFilters['SleeveArray'];
                $PatternArray = $productFilters['PatternArray'];
                $FitArray = $productFilters['FitArray'];
                $OcassionArray = $productFilters['OcassionArray'];
                return view('frontend.listing.index')->with(compact('categoryDetails', 'categoryProducts', 'url', 'FabricArray', 'SleeveArray', 'PatternArray', 'FitArray', 'OcassionArray'));
            } else {
                abort(404);
            }
        }
    }
    public function show($slug)
    {
        $productDetails = Product::with(['brand', 'category', 'section', 'attributes' => function ($query) {
            $query->where('status', 1);
        }, 'images'])->where('slug', $slug)->first()->toArray();
        $relateProducts = Product::where('category_id', $productDetails['category_id'])->with('brand', 'category', 'section', 'attributes', 'images')->where('id', '!=', $productDetails['id'])->inRandomOrder()->limit(5)->get();
        $produt_stock = ProductAttribute::where('product_id', $productDetails['id'])->sum('stock');
        return view('frontend.product.details', compact('productDetails', 'produt_stock', 'relateProducts'));
    }
    public function getPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $disconted_attri_price = Product::getDiscountedAttributePrice($data['product_id'], $data['size']);
            return $disconted_attri_price;
        }
    }
    public function addToCart(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();
            $getProductStock = ProductAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first()->toArray();
            // Get stock
            if ($getProductStock['stock'] < $data['quantity']) {
                toastr()->error('Sorry out of stock ! you can add less ' . $getProductStock['stock'] . ' product in your cart');
                return back();
            }

            //generate Session id
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            //Auth check
            if (Auth::check()) {
                //Cheack size already exists in cart
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => Auth::user()->id])->count();
            } else {
                //Cheack size already exists in cart
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => Session::get('session_id')])->count();
            }
            if ($countProducts > 0) {
                toastr()->error($data['size'] . ' Product has been already added in your cart');
                return back();
            }

            Cart::create([
                'session_id' => $session_id,
                'size' => $data['size'],
                'product_id' => $data['product_id'],
                'quantity' => $data['quantity'],
            ]);
            toastr()->success('Prouduct has been  added in cart!');
            return redirect()->route('admin.productlisting.cart');
        }
    }

    // Cart product
    public function cart()
    {
        $userCartItems = Cart::userCartItems();
        // echo "<pre>";
        // print_r($userCartItems);die;
        return view('frontend.cart.cart', compact('userCartItems'));
    }




    //Update Cart item
    public function updateCartItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $cartDetails = Cart::find($data['cartid']);
            $availblestock = ProductAttribute::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->first()->toArray();
            $userCartItems = Cart::userCartItems();
            if ($data['quantity'] > $availblestock['stock']) {
                return response()->json([
                    'status' => false,
                    'view' => (string)View::make('frontend.cart.cart_item')->with(compact('userCartItems'))
                ]);
            }
            Cart::where('id', $data['cartid'])->update(['quantity' => $data['quantity']]);
            $userCartItems = Cart::userCartItems();
            return response()->json([
                'status' => true,
                'view' => (string)View::make('frontend.cart.cart_item')->with(compact('userCartItems'))
            ]);
        }
    }

    //Delete cart item
    public function deleteCartItem(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Cart::where('id', $data['cartid'])->delete();
            $userCartItems = Cart::userCartItems();
            return response()->json([
                'view' => (string)View::make('frontend.cart.cart_item')->with(compact('userCartItems'))
            ]);
        }
    }
}
