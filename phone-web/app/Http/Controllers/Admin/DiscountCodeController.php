<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DiscountCodeModel;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
{
    public function list( )
    {
        $data['getRecord'] = DiscountCodeModel::getRecord();
        $data['header_title'] ='Discount Code';
        return view('admin.discount_code.list',$data);
    }

    public function add(){
        $data['header_title'] ='Add New Discount Code';
        return view('admin.discount_code.add',$data);
    }

    public function insert(Request $request){
        $discount_code = new DiscountCodeModel();
        $discount_code->name = trim($request->name);
        $discount_code->type = trim($request->type);
        $discount_code->percent_amount = trim($request->percent_amount);
        $discount_code->expire_date = trim($request->expire_date);
        $discount_code->status = trim($request->status);
        $discount_code->save();

        return redirect('admin/discount_code/list')->with('success', "Discount Code successfully created");
    }

    public function edit($id){
        $data['getRecord'] = DiscountCodeModel::getSingle($id);
        $data['header_title'] ='Edit Discount Code';
        return view('admin.discount_code.edit',$data);
    }

    public function update($id, Request $request){
        $discount_code = DiscountCodeModel::getSingle($id);
        $discount_code->name = trim($request->name);
        $discount_code->type = trim($request->type);
        $discount_code->percent_amount = trim($request->percent_amount);
        $discount_code->expire_date = trim($request->expire_date);
        $discount_code->status = trim($request->status);
        $discount_code->save();

        return redirect('admin/discount_code/list')->with('success', "Discount Code successfully updated");
    }

    public function delete($id){
        $discount_code = DiscountCodeModel::getSingle($id);
        $discount_code->is_delete = 1;
        $discount_code->save();

        return redirect()->back()->with('success', "Discount Code Successfully Deleted");
    }
}
