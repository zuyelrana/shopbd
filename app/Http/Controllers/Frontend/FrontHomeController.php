<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    public function index()
    {
        $banners=Banner::where('status',1)->get();
        $latestProducts=Product::where('status',1)->orderBy('id','desc')->take(8)->get();
        $ourfeatures=Product::where(['status'=>1, 'is_featured'=>'Yes'])->orderBy('id','desc')->take(8)->get();
        $browsecategories=Category::where(['parent_id'=>0,'status'=>1])->take(4)->get();
        return view('frontend.home.home',compact('banners', 'latestProducts', 'ourfeatures', 'browsecategories'));
    }
}
