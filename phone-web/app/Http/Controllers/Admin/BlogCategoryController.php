<?php

namespace App\Http\Controllers\Admin;
use App\Models\BlogCategoryModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogCategoryController extends Controller
{
    public function list( )
    {
        $data['getRecord'] = BlogCategoryModel::getRecord();
        $data['header_title'] ='Blog Category';
        return view('admin.blog_category.list',$data);
    }

    public function add(){
        $data['header_title'] ='Add New Blog Category';
        return view('admin.blog_category.add',$data);
    }

    public function insert(Request $request){
        // request()->validate([
        //     'slug' => 'required|unique:blog_category'
        // ]);

        $blogcategory = new BlogCategoryModel;
        $blogcategory->name = trim($request->name);
        $blogcategory->slug = trim($request->slug);
        $blogcategory->status = trim($request->status);
        $blogcategory->meta_title = trim($request->meta_title);
        $blogcategory->meta_description = trim($request->meta_description);
        $blogcategory->meta_keywords = trim($request->key_words);
        $blogcategory->save();

        return redirect('admin/blog_category/list')->with('success', "Blog Category successfully created");
    }

    public function edit($id){
        $data['getRecord'] = BlogCategoryModel::getSingle($id);
        $data['header_title'] ='Edit Blog Category';
        return view('admin.blog_category.edit',$data);
    }

    public function update($id, Request $request){
        // request()->validate([
        //     'slug' => 'required|unique:blog_category,slug, '. $id
        // ]);

        $blogcategory = BlogCategoryModel::getSingle($id);
        $blogcategory->name = trim($request->name);
        $blogcategory->slug = trim($request->slug);
        $blogcategory->status = trim($request->status);
        $blogcategory->meta_title = trim($request->meta_title);
        $blogcategory->meta_description = trim($request->meta_description);
        $blogcategory->meta_keywords = trim($request->meta_keywords);
        $blogcategory->save();

        return redirect('admin/blog_category/list')->with('success', "Blog Category successfully updated");
    }

    public function delete($id){
        $blogcategory = BlogCategoryModel::getSingle($id);
        $blogcategory->is_delete = 1;
        $blogcategory->save();

        return redirect()->back()->with('success', "Blog Category Successfully Deleted");
    }
}
