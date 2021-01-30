<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        $sections = Section::all();
        return view('backend.section.index', compact('sections'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|unique:sections',
        ]);
        Section::create([
            'name' => $request->name,
        ]);
        toastr()->success('Section created Succesfully');
        return redirect()->route("admin.section.index");
    }



    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => "required|string|unique:sections,name,$request->id",
        ]);
        $section = Section::findOrFail($request->id);
        $section->update([
            'name' => $request->name,
        ]);

        toastr()->success('Section updated Succesfully');
        return redirect()->route("admin.section.index");
    }

    public function destroy(Section $section)
    {
        $section->delete();
        toastr()->success('Section deleted Succesfully');
        return redirect()->route("admin.section.index");
    }
    public function published(Section $section)
    {
        $section->update([
            'status' => true,
        ]);
        toastr()->success('Section published Succesfully');
        return redirect()->route("admin.section.index");
    }
    public function unpublished(Section $section)
    {
        $section->update([
            'status' => false,
        ]);
        toastr()->success('Section unpublished Succesfully');
        return redirect()->route("admin.section.index");
    }
}
