<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function list( )
    {
        $data['getRecord'] = OrderModel::getRecord();
        $data['header_title'] ='Order';
        return view('admin.order.list',$data);
    }

    public function order_detail($id){
        $data['getRecord'] = OrderModel::getSingle($id);
        $data['header_title'] ='Order Detail';
        return view('admin.order.detail',$data);
    }

    public function order_status(Request $request){
        $getOrder = OrderModel::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();
        $json['message'] = "Status successfully updated";
        echo json_encode($json);
    }
}
