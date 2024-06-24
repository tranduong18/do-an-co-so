<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingChargeModel;
use Illuminate\Support\Facades\Auth;

class ShippingChargeController extends Controller
{
    public function list( )
    {
        $data['getRecord'] = ShippingChargeModel::getRecord();
        $data['header_title'] ='Shipping Charge';
        return view('admin.shipping_charge.list',$data);
    }

    public function add(){
        $data['header_title'] ='Add New Shipping Charge';
        return view('admin.shipping_charge.add',$data);
    }

    public function insert(Request $request){
        $shipping_charge = new ShippingChargeModel();
        $shipping_charge->name = trim($request->name);
        $shipping_charge->price = trim($request->price);
        $shipping_charge->status = trim($request->status);
        $shipping_charge->save();

        return redirect('admin/shipping_charge/list')->with('success', "Shipping Charge successfully created");
    }

    public function edit($id){
        $data['getRecord'] = ShippingChargeModel::getSingle($id);
        $data['header_title'] ='Edit Shipping Charge';
        return view('admin.shipping_charge.edit',$data);
    }

    public function update($id, Request $request){
        $shipping_charge = ShippingChargeModel::getSingle($id);
        $shipping_charge->name = trim($request->name);
        $shipping_charge->price = trim($request->price);
        $shipping_charge->status = trim($request->status);
        $shipping_charge->save();

        return redirect('admin/shipping_charge/list')->with('success', "Shipping Charge successfully updated");
    }

    public function delete($id){
        $shipping_charge = ShippingChargeModel::getSingle($id);
        $shipping_charge->is_delete = 1;
        $shipping_charge->save();

        return redirect()->back()->with('success', "Shipping Charge Successfully Deleted");
    }
}
