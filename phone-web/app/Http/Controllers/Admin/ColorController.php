<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ColorModel;
use Auth;

class ColorController extends Controller
{
    public function list()
    {
        $data['getRecord'] = ColorModel::get(); // Assuming getRecord() method doesn't exist in ColorModel
        $data['header_title'] = 'Color';
        return view('admin.color.list', $data);
    }

    public function add()
    {
        $data['header_title'] = 'Add New Color';
        return view('admin.color.add', $data); // Changed to admin.color.add
    }

    public function insert(Request $request)
    {
        $color = new ColorModel();
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        $color->created_by = Auth::user()->id;
        $color->save();

        // $color->created_by = Auth::user()->id;
        $color->save();

        return redirect('admin/color/list')->with('success', "Color successfully created");
    }

    public function edit($id)
    {
        $data['getRecord'] = ColorModel::find($id); // Assuming getSingle() method doesn't exist, replaced with find()
        $data['header_title'] = 'Edit Color';
        return view('admin.color.edit', $data); // Changed to admin.color.edit
    }

    public function update($id, Request $request)
    {
      
        $color = ColorModel::find($id); // Assuming getSingle() method doesn't exist, replaced with find()
        $color->name = trim($request->name);
        $color->code = trim($request->code);
        $color->status = trim($request->status);
        
        $color->save();

        return redirect('admin/color/list')->with('success', "Color successfully updated");
    }

    public function delete($id)
    {
        $color = ColorModel::find($id); // Assuming getSingle() method doesn't exist, replaced with find()
        $color->delete();

        return redirect()->back()->with('success', 'Color successfully deleted');
    }
}
