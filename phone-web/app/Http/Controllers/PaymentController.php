<?php

namespace App\Http\Controllers;

use App\Models\ProductModel;
use App\Models\ProductSizeModel;
use App\Models\DiscountCodeModel;
use App\Models\ShippingChargeModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ColorModel;
use App\Models\NotificationModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $data['meta_title'] = 'Checkout';
        $data['meta_keyword'] = '';
        $data['meta_description'] = '';
        $data['getShipping'] = ShippingChargeModel::getRecordActive();
        return view('payment.checkout', $data);
    }

    public function apply_discount_code(Request $request)
    {
        $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
        if (!empty($getDiscount)) {
            $total = Cart::getSubTotal();
            if ($getDiscount->type == 'Amount') {
                $discount_amount = $getDiscount->percent_amount;
                $payable_total = $total - $getDiscount->percent_amount;
            } else {
                $discount_amount = ($total * $getDiscount->percent_amount) / 100;
                $payable_total = $total - $discount_amount;
            }

            $json['status'] = true;
            $json['discount_amount'] = number_format($discount_amount, 2);
            $json['payable_total'] = $payable_total;
            $json['message'] = "Success";
        } else {
            $json['status'] = false;
            $json['discount_amount'] = '0.00';
            $json['payable_total'] = Cart::getSubTotal();
            $json['message'] = "Discount Code Invalid";
        }
        echo json_encode($json);
    }

    public function cart(Request $request)
    {
        $data['meta_title'] = 'Cart';
        $data['meta_keyword'] = '';
        $data['meta_description'] = '';
        return view('payment.cart', $data);
    }
    public function cart_delete($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
    public function update_cart(Request $request)
    {
        foreach ($request->cart as $cart) {
            Cart::update(
                $cart['id'],
                array(
                    'quantity' => array(
                        'relative' => false,
                        'value' => $cart['qty']
                    )
                )
            );
        }
        return redirect()->back();
    }

    public function add_to_cart(Request $request)
    {
        $getProduct = ProductModel::getSingle($request->product_id);
        $total = $getProduct->price;
        $quantity = !empty($request->qty) ? $request->qty : 1;
        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSizeModel::getSingle($size_id);
            $size_price = !empty($getSize->price) ? $getSize->price : $total;
            $total  = $size_price + $total;
        } else {
            $size_id = 0;
        }
        $color_id = !empty($request->color_id) ? $request->color_id : 0;

        Cart::add([
            'id' => $getProduct->id,
            'name' => 'Product',
            'price' => $total,
            'quantity' => $quantity,
            'attributes' => array(
                'color_id' => $color_id,
                'size_id' => $size_id,
            ),

        ]);
        return redirect()->back();
    }

    public function place_order(Request $request)
    {
        $validate = 0;
        $message = '';

        if (!empty(Auth::check())) {
            $user_id = Auth::user()->id;
        } else {
            if (!empty($request->is_create)) {
                $checkEmail = User::checkEmail($request->email);
                if (!empty($checkEmail)) {
                    $validate = 1;
                    $message = "This email already register, please choose another";
                } else {
                    $user = new User;
                    $user->name =  trim($request->first_name);
                    $user->email = trim($request->email);
                    $user->password = Hash::make($request->password);
                    $user->save();
                    $user_id = $user->id;
                }
            } else {
                $user_id = '';
            }
        }


        if (empty($validate)) {
            $getShipping = ShippingChargeModel::getSingle($request->shipping);
            $payable_total = Cart::getSubTotal();
            $discount_amount = 0;
            $discount_code = '';
            if (!empty($request->discount_code)) {
                $getDiscount = DiscountCodeModel::CheckDiscount($request->discount_code);
                if (!empty($getDiscount)) {
                    $discount_code = $request->discount_code;
                    if ($getDiscount->type == 'Amount') {
                        $discount_amount = $getDiscount->percent_amount;
                        $payable_total = $payable_total - $getDiscount->percent_amount;
                    } else {
                        $discount_amount = ($payable_total * $getDiscount->percent_amount) / 100;
                        $payable_total = $payable_total - $discount_amount;
                    }
                }
            }
            $shipping_amount = !empty($getShipping->price) ? $getShipping->price : 0;
            $total_amount = $payable_total + $shipping_amount;

            $order = new OrderModel();
            if (!empty($user_id)) {
                $order->user_id = trim($user_id);
            }
            $order->first_name = trim($request->first_name);
            $order->last_name = trim($request->last_name);
            $order->company_name = trim($request->company_name);
            $order->country = trim($request->country);
            $order->address_one = trim($request->address_one);
            $order->address_two = trim($request->address_two);
            $order->city = trim($request->city);
            $order->state = trim($request->state);
            $order->postcode = trim($request->postcode);
            $order->phone = trim($request->phone);
            $order->email = trim($request->email);
            $order->note = trim($request->note);
            $order->discount_code = trim($discount_code);
            $order->discount_amount = trim($discount_amount);
            $order->shipping_id = trim($request->shipping);
            $order->shipping_amount = trim($shipping_amount);
            $order->total_amount = trim($total_amount);

            $order->payment_method = trim($request->payment_method);
            $order->save();

            foreach (Cart::getContent() as $key => $cart) {
                $order_item = new OrderItemModel();
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart->id;
                $order_item->quantity = $cart->quantity;
                $order_item->price = $cart->price;

                $color_id = $cart->attributes->color_id;
                if (!empty($color_id)) {
                    $getColor = ColorModel::getSingle($color_id);
                    $order_item->color_name = $getColor->name;
                }

                $size_id = $cart->attributes->size_id;
                if (!empty($size_id)) {
                    $getSize = ProductSizeModel::getSingle($size_id);
                    $order_item->size_name = $getSize->name;
                    $order_item->size_amount = $getSize->price;
                }

                $order_item->total_price = $cart->price * $cart->quantity;
                $order_item->save();
            }
            $json['status'] = true;
            $json['message'] = "Success";
            $json['redirect'] = url('checkout/payment?order_id=' . base64_encode($order->id));
        } else {
            $json['status'] = false;
            $json['message'] = $message;
        }
        echo json_encode($json);
    }

    public function vnpayReturn(Request $request)
    {
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');

        // Tìm order bằng mã đơn hàng đã gửi
        $getOrder = OrderModel::where('id', $vnp_TxnRef)->first();

        if ($vnp_ResponseCode == '00' && !empty($getOrder)) {
            $getOrder->is_payment = 1;
            $getOrder->save();

            // Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
            $user_id = 1;
            $url = url('admin/order/detail/' . $getOrder->id);
            $message = "New Order Placed #" . $getOrder->id;
            NotificationModel::insertRecord($user_id, $url, $message);

            Cart::clear();
            return redirect('cart')->with('success', "Order successfully placed");
        } else {
            return redirect('cart')->with('error', "Payment failed or order not found");
        }
    }


    public function checkout_payment(Request $request)
    {
        if (!empty(Cart::getSubTotal()) && !empty($request->order_id)) {
            $order_id = base64_decode($request->order_id);
            $getOrder = OrderModel::getSingle($order_id);
            if (!empty($getOrder)) {
                if ($getOrder->payment_method == 'cash') {
                    $getOrder->is_payment = 1;
                    $getOrder->save();

                    // Mail::to($getOrder->email)->send(new OrderInvoiceMail($getOrder));
                    $user_id = 1;
                    $url = url('admin/order/detail/' . $getOrder->id);
                    $message = "New Order Placed #" . $getOrder->id;
                    NotificationModel::insertRecord($user_id, $url,  $message);

                    Cart::clear();
                    return redirect('cart')->with('success', "Order successfully placed");
                } else if ($getOrder->payment_method == 'vnpay') {
                    $vnp_TmnCode = "GHHNT2HB"; // Mã website tại VNPAY 
                    $vnp_HashSecret = "BAGAOHAPRHKQZASKQZASVPRSAKPXNYXS"; // Chuỗi bí mật

                    $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
                    $vnp_Returnurl = "http://localhost/do-an-co-so/phone-web/public/vnpay_return"; // Đổi URL này thành URL thực tế của bạn
                    $vnp_TxnRef = $getOrder->id; // Mã đơn hàng là ID của đơn hàng
                    $vnp_OrderInfo = "Thanh toán hóa đơn phí dịch vụ";
                    $vnp_OrderType = 'billpayment';
                    $vnp_Amount = $getOrder->total_amount * 100; // Số tiền thanh toán (đơn vị: VND)
                    $vnp_Locale = 'vn';
                    $vnp_IpAddr = request()->ip();

                    $inputData = array(
                        "vnp_Version" => "2.0.0",
                        "vnp_TmnCode" => $vnp_TmnCode,
                        "vnp_Amount" => $vnp_Amount,
                        "vnp_Command" => "pay",
                        "vnp_CreateDate" => date('YmdHis'),
                        "vnp_CurrCode" => "VND",
                        "vnp_IpAddr" => $vnp_IpAddr,
                        "vnp_Locale" => $vnp_Locale,
                        "vnp_OrderInfo" => $vnp_OrderInfo,
                        "vnp_OrderType" => $vnp_OrderType,
                        "vnp_ReturnUrl" => $vnp_Returnurl,
                        "vnp_TxnRef" => $vnp_TxnRef,
                    );

                    ksort($inputData);
                    $query = "";
                    $i = 0;
                    $hashdata = "";
                    foreach ($inputData as $key => $value) {
                        if ($i == 1) {
                            $hashdata .= '&' . $key . "=" . $value;
                        } else {
                            $hashdata .= $key . "=" . $value;
                            $i = 1;
                        }
                        $query .= urlencode($key) . "=" . urlencode($value) . '&';
                    }

                    $vnp_Url = $vnp_Url . "?" . $query;
                    if (isset($vnp_HashSecret)) {
                        $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
                        $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
                    }

                    return redirect($vnp_Url);
                }
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }
    }
}
