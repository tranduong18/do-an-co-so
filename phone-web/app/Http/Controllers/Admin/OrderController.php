<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderModel;
use App\Models\NotificationModel;

use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function list( )
    {
        $data['getRecord'] = OrderModel::getRecord();
        $data['header_title'] ='Order';
        return view('admin.order.list',$data);
    }

    public function order_detail($id, Request $request)
    {
        if(!empty($request->noti_id))
        {
            NotificationModel::updateReadNoti($request->noti_id);
        }
        $data['getRecord'] = OrderModel::getSingle($id);
        $data['header_title'] ='Order Detail';
        return view('admin.order.detail',$data);
    }

    public function order_status(Request $request){
        $getOrder = OrderModel::getSingle($request->order_id);
        $getOrder->status = $request->status;
        $getOrder->save();

        $user_id= $getOrder->user_id;
        $url = url('user/orders');
        $message = " Your Order Status Updated #" .$getOrder->order_number;
        NotificationModel::insertRecord($user_id, $url,  $message);


        $json['message'] = "Status successfully updated";
        echo json_encode($json);
    }
}
