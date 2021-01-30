<?php

namespace App\Http\Controllers\Admin;

use App\Models\Section;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{

	public function index()
	{
		$categories = Category::with(['section', 'parentcategory'])->orderBy('id', 'desc')->get();
		// return $categories;
		return view('backend.category.index', compact('categories'));
	}


	public function addEditCategory(Request $request, $id = null)
	{

		$categories = Category::all();
		$sections = Section::all();
		if ($id == "") {
			$title = "Add Category";
			$categorydata = array();
			$getCategories = array();
		} else {
			$title = "Edit Category";
			$categorydata = Category::where('id', $id)->first();
			$categorydata = json_decode(json_encode($categorydata), true);
			$getCategories = Category::with('subCategories')->where(['section_id' => $categorydata['section_id'], 'parent_id' => 0, 'status' =>  true])->get();
			$getCategories = json_decode(json_encode($getCategories), true);
		
		}
		return view('backend.category.add_edit_form')->with(compact('title', 'categories', 'sections', 'categorydata', 'getCategories'));
	}

	public function store(Request $request)
	{
		$category = new Category();
		// return $request;
		$data = $request->all();
		$this->validate($request, [
			'section_id' => 'required|integer',
			'category_name' => 'required|string',
			'category_name' => "required|string|unique:categories,category_name",
			'description' => 'required|string',
			'category_discount' => 'required|string',
			'meta_title' => 'string',
			'meta_description' => 'string',
			'meta_keywords' => 'string',
		]);
		$category->parent_id = $data['parent_id'];
		$category->section_id = $data['section_id'];
		$category->category_name = $data['category_name'];
		$category->category_discount = $data['category_discount'];
		$category->description = $data['description'];
		$category->meta_title = $data['meta_title'];
		$category->meta_description = $data['meta_description'];
		$category->meta_keywords = $data['meta_keywords'];
		$category->url = Str::slug($data['category_name']);
		$category->category_image = $this->uploadeImage($request);
		$category->status = true;
		$category->save();
		toastr()->success('Category Added Succesfully !');
		return redirect()->route('admin.category.index');
	}
	public function update(Request $request, $id)
	{

		$request->validate([
			'section_id' => 'required|integer',
			'category_name' => "required|string|unique:categories,category_name,$id",
			'description' => 'required|string',
			'category_discount' => 'required|string',
			'meta_title' => 'string',
			'meta_description' => 'string',
			'meta_keywords' => 'string',

		]);
		$category = Category::findOrFail($id);
		$category->parent_id = $request->parent_id;
		$category->section_id = $request->section_id;
		$category->category_name = $request->category_name;
		$category->category_discount = $request->category_discount;
		$category->description = $request->description;
		$category->meta_title = $request->meta_title;
		$category->meta_description = $request->meta_description;
		$category->meta_keywords = $request->meta_keywords;
		$category->url = Str::slug($request->category_name);
		$category->status = true;
		$file1 = $request->file("category_image");
		if ($file1) {
			if (file_exists($category->category_image)) {
				unlink($category->category_image);
			}
			$category->category_image = $this->uploadeImage($request);
		}
		$category->save();
		toastr()->success('Category updated Succesfully !');
		return redirect()->route('admin.category.index');
	}


	public function appendCategory(Request $request)
	{
		if ($request->ajax()) {
			$data = $request->all();
			$getCategories = Category::with('subCategories')->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' =>  true])->get();
			$getCategories = json_decode(json_encode($getCategories), true);
			return view('backend.category.append_category_lavel')->with(compact('getCategories'));
		}
	}

	public function updateCategoryStatus(Request $request)
	{
		if ($request->ajax()) {
			$data = $request->all();
			if ($data['status'] == "Active") {
				$status = false;
			} else {
				$status = true;
			}
			Category::where('id', $data['category_id'])->update(['status' => $status]);
			return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
		}
		toastr()->success('category unpublished Succesfully');
		return redirect()->route('admin.category.index');
	}


	public function destroy($id)
	{

		$delete = Category::find($id);
		$image_finding = $delete->category_image;
		if (file_exists($image_finding)) { //If it exits, delete it from folder
			unlink($image_finding);
		}
		$delete->delete();
		toastr()->success('category unpublished Succesfully');
		return redirect()->route('admin.category.index');
	}

	protected function uploadeImage($request)
	{
		$file = $request->file("category_image");
		// Make new Name Name
		$get_imageName = date('mdYHis') . uniqid() . $file->getClientOriginalName();
		// Get Name
		$directory = 'backend/assets/images/category/';
		// Image Url
		$imageUrl = $directory . $get_imageName;
		// $file->move($directory, $imageUrl);
		Image::make($file)->resize(300, 300)->save($imageUrl);
		return $imageUrl;
	}
}
