<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\SubCategoryModel;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function list( )
    {
        $data['getRecord'] = SubCategoryModel::getRecord();
        $data['header_title'] ='Sub Category';
        return view('admin.sub_category.list',$data);
    }

    public function add(){
        $data['getCategory'] = CategoryModel::getRecord();
        $data['header_title'] ='Add New Sub Category';
        return view('admin.sub_category.add',$data);
    }

    public function insert(Request $request){
        request()->validate([
            'slug' => 'required|unique:sub_category'
        ]);

        $sub_category = new SubCategoryModel();
        $sub_category->category_id = trim($request->category_id);
        $sub_category->name = trim($request->name);
        $sub_category->slug = trim($request->slug);
        $sub_category->status = trim($request->status);
        $sub_category->meta_title = trim($request->meta_title);
        $sub_category->meta_description = trim($request->meta_description);
        $sub_category->meta_keywords = trim($request->key_words);
        $sub_category->created_by = Auth::user()->id;
        $sub_category->save();

        return redirect('admin/sub_category/list')->with('success', "Sub Category successfully created");
    }

    public function edit($id){
        $data['getCategory'] = CategoryModel::getRecord();
        $data['getRecord'] = SubCategoryModel::getSingle($id);
        $data['header_title'] ='Edit Sub Category';
        return view('admin.sub_category.edit',$data);
    }

    public function update($id, Request $request){
        request()->validate([
            'slug' => 'required|unique:sub_category,slug,' . $id
        ]);

        $sub_category = SubCategoryModel::getSingle($id);
        $sub_category->category_id = trim($request->category_id);
        $sub_category->name = trim($request->name);
        $sub_category->slug = trim($request->slug);
        $sub_category->status = trim($request->status);
        $sub_category->meta_title = trim($request->meta_title);
        $sub_category->meta_description = trim($request->meta_description);
        $sub_category->meta_keywords = trim($request->meta_keywords);
        $sub_category->save();

        return redirect('admin/sub_category/list')->with('success', "Sub Category successfully updated");
    }

    public function delete($id){
        $sub_category = SubCategoryModel::getSingle($id);
        $sub_category->is_delete = 1;
        $sub_category->save();

        return redirect()->back()->with('success', "Sub Category Successfully Deleted");
    }

    public function get_sub_category(Request $request){
        $category_id = $request->id;
        $get_sub_category = SubCategoryModel::getRecordSubCategory($category_id);
        $html = '';
        $html .= '<option value="">Select</option>';
        foreach ($get_sub_category as $value) {
            $html .= '<option value="' .$value->id. '">'.$value->name. '</option>';
        }
        $json['html'] = $html;
        echo json_encode($json);
    }
}
