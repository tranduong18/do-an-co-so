<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use Auth;

class SubcategoryController extends Controller
{
    public function list(){
        $data['getRecord'] = CategoryModel::getRecord();
        $data['header_title'] = 'Sub Category';
        return view('admin.category.list', $data);
    }

}
