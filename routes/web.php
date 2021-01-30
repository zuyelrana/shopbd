<?php

use App\Models\Section;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Frontend\FrontHomeController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Frontend\ProductListingController;
use App\Models\Cart;

Route::get('/', function () {

  return view('welcome');
});

Auth::routes();

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth',]], function () {
  Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

  // Manage Section
  Route::get('/section', [SectionController::class, 'index'])->name('section.index');
  Route::post('/section/create/', [SectionController::class, 'store'])->name('section.store');
  Route::post('/section/update/', [SectionController::class, 'update'])->name('section.update');
  Route::get('/section/destroy/{section}', [SectionController::class, 'destroy'])->name('section.destroy');
  Route::get('/section/unpublished/{section}', [SectionController::class, 'unpublished'])->name('section.unpublished');
  Route::get('/section/published/{section}', [SectionController::class, 'published'])->name('section.published');


  // Manage Section
  Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
  Route::post('/brand/create/', [BrandController::class, 'store'])->name('brand.store');
  Route::post('/brand/update/', [BrandController::class, 'update'])->name('brand.update');
  Route::get('/brand/destroy/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');
  Route::get('/brand/unpublished/{brand}', [BrandController::class, 'unpublished'])->name('brand.unpublished');
  Route::get('/brand/published/{brand}', [BrandController::class, 'published'])->name('brand.published');



  // Manage Category
  Route::get('category', [CategoryController::class, 'index'])->name('category.index');
  Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
  Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
  Route::post('/category/update-status', [CategoryController::class, 'updateCategoryStatus']);
  Route::get('/category/add-edit-category/{id?}', [CategoryController::class, 'addEditCategory'])->name('category.add_edit_category');
  Route::get('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
  Route::post('append-category-lavel', [CategoryController::class, 'appendCategory'])->name('category.appendCategory');


  // Manage Product
  Route::get('product', [ProductController::class, 'index'])->name('product.index');
  Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
  Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
  Route::post('/product/update-status', [ProductController::class, 'updateProductStatus']);
  Route::get('/product/add-edit-product/{id?}', [ProductController::class, 'addEditProduct'])->name('product.add_edit_product');
  Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
  // Product Attribute
  Route::match(['get', 'post'], 'product/attribute/{id}', [ProductAttributeController::class, 'addAttribute'])->name('productattribute.addAttribute');
  Route::post('product/attribute/update/{id}',[ProductAttributeController::class, 'updateAttribute'])->name('productattribute.update');
  Route::get('/product/attribute/unpublished/{attribute}', [ProductAttributeController::class, 'unpublished'])->name('productattribute.unpublished');
  Route::get('/product/attribute/published/{attribute}', [ProductAttributeController::class, 'published'])->name('productattribute.published');


  // Product Attribute
  Route::match(['get', 'post'], 'product/image/{id?}', [ProductImageController::class, 'addProductImage'])->name('productimages.addProductImage');
  Route::get('/product/image/unpublished/{productImage}', [ProductImageController::class, 'unpublished'])->name('productimages.unpublished');
  Route::get('/product/image/published/{productImage}', [ProductImageController::class, 'published'])->name('productimages.published');
  Route::get('/product/image/destroy/{productImage}', [ProductImageController::class, 'destroy'])->name('productimages.destroy');

  // 
  // Banner Management
  Route::match(['get', 'post'],'/banner/image/add-edit/{id?}', [BannerController::class, 'addBannerImage'])->name('banner.addBannerImage');
  Route::get('/banner/image', [BannerController::class, 'index'])->name('banner.index');
  Route::post('/banner/image/update/{id}', [BannerController::class, 'update'])->name('banner.update');
  Route::get('/product/banner/image/destroy/{id}', [BannerController::class, 'destroy'])->name('banner.destroy');



  

});
// Ckeditor
Route::post('ckeditor/upload', [ProductController::class, 'upload'])->name('ckeditor.upload');




// Frontend
Route::group(['as' => 'admin.'], function () {
  Route::get('/', [FrontHomeController::class, 'index'])->name('home.index');
  Route::get('/cart', [ProductListingController::class, 'cart'])->name('productlisting.cart');
  // Product Listing Controller
  Route::get('/{url}', [ProductListingController::class, 'index'])->name('productlisting.index');
  Route::get('product/detais/{slug}',[ProductListingController::class,'show'])->name('productlisting.show');
  // Get price
  Route::post('/get-product-price', [ProductListingController::class, 'getPrice']);
  Route::post('/add-to-cart', [ProductListingController::class, 'addToCart'])->name('productlisting.add_to_cart');

  //Update cart Item 
  Route::post('/update-cart-item-quantity', [ProductListingController::class, 'updateCartItem'])->name('productlisting.updateCartItem');

  //Delete cart Item 
  Route::post('/delete-cart-item', [ProductListingController::class, 'deleteCartItem'])->name('productlisting.deleteCartItem');
 
});



// Menu
view()->composer('frontend.include.header', function ($view) {
  $userCartItems = Cart::userCartItems();
  $sections = Section::with('categories')->where('status', 1)->get()->toArray();
  $view->with('sections', $sections);
  $view->with('userCartItems', $userCartItems);
});
view()->composer('frontend.include.mobileMenu', function ($view) {
  $sections = Section::with('categories')->where('status', 1)->get()->toArray();
  $view->with('sections', $sections);
});

view()->composer('frontend.include.filter', function ($view) {
  $sections = Section::with('categories')->where('status', 1)->get()->toArray();
  $view->with('sections', $sections);
});
