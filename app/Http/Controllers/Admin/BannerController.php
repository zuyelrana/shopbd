<?php

namespace App\Http\Controllers\Admin;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('backend.banner.index', compact('banners'));
    }
    public function addBannerImage(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Banner";
            $banner = "";
        } else {
            $title = "Edit Banner";
            $banner = Banner::find($id);
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'title' => 'required|string',
                'alt' => 'required|string',
                'link' => 'required|string',
                'image' => 'required',
            ]);
            $bannersave = new Banner();
            $bannersave->title = $request->title;
            $bannersave->alt = $request->alt;
            $bannersave->link = $request->link;
            if (empty($request->status)) {
                $bannersave->status = false;
            } else {
                $bannersave->status = true;
            }
            $bannersave->image = $this->uploadeImage($request);
            $bannersave->save();
            toastr()->info("Banner image added Succesfully");
            return redirect()->route('admin.banner.index');
        }
        return view('backend.banner.add_edit', compact('title', 'banner'));
    }
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'title' => 'required|string',
            'alt' => 'required|string',
            'link' => 'required|string',
        ]);
        $banner =  Banner::find($id);
        $banner->title = $request->title;
        $banner->alt = $request->alt;
        $banner->link = $request->link;
        if (!empty($request->status)) {
            $banner->status = true;
        } else {
            $banner->status = false;
        }
        $file = $request->file('image');
        if ($file) {
            if (file_exists("backend/assets/images/banner/" . $banner->image)) {
                unlink("backend/assets/images/banner/" . $banner->image);
            }
            $banner->image = $this->uploadeImage($request);
        }

        $banner->save();
        toastr()->info("Banner image added Succesfully");
        return redirect()->route('admin.banner.index');
    }

    public function destroy($id)
    {
        $banner =  Banner::find($id);

        if (file_exists("backend/assets/images/banner/" . $banner->image)) {
            unlink("backend/assets/images/banner/" . $banner->image);
        }

        $banner->delete();
        toastr()->success("Banner image deleted Succesfully");
        return redirect()->route('admin.banner.index');
    }

    protected function uploadeImage($request)
    {
        if ($request->hasFile('image')) {
            $image_tmp = $request->file('image');
            if ($image_tmp->isValid()) {
                // uplode Image
                $imageNewName = date('mdYHis') . uniqid() . $image_tmp->getClientOriginalName();
                $banner_path = 'backend/assets/images/banner/' . $imageNewName;
                Image::make($image_tmp)->resize(1180, 630)->save($banner_path);
                return $imageNewName;
            }
        }
    }
}
