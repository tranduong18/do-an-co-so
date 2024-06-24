@extends('layouts.app')
@section('style')

@endsection
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <form action="" id="SubmitForm" method="post">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-9">
                            <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>First Name *</label>
                                    <input type="text" value="{{!empty(Auth::user()->name) ?Auth::user()->name : '' }}" name="first_name" class="form-control" required>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Last Name *</label>
                                    <input type="text" value="{{!empty(Auth::user()->last_name) ?Auth::user()->last_name : '' }}" name="last_name" class="form-control" required>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label>Company Name (Optional)</label>
                            <input type="text" value="{{!empty(Auth::user()->company_name) ?Auth::user()->company_name : '' }}" name="company_name" class="form-control">

                            <label>Country *</label>
                            <input type="text" value="{{!empty(Auth::user()->country) ?Auth::user()->country : '' }}" name="country" class="form-control" required>

                            <label>Address *</label>
                            <input type="text" value="{{!empty(Auth::user()->address_one) ?Auth::user()->address_one : '' }}" name="address_one" class="form-control" placeholder="" required>
                            <!-- <input type="text" name="address_two" class="form-control" placeholder="Appartments, suite, unit etc ..." required> -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Town / City *</label>
                                    <input type="text" value="{{!empty(Auth::user()->city) ?Auth::user()->city : '' }}" name="city" class="form-control" required>
                                </div><!-- End .col-sm-6 -->

                                <!-- <div class="col-sm-6">
                                    <label>State *</label>
                                    <input type="text" name="state" class="form-control" required>
                                </div> -->
                            </div><!-- End .row -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Postcode / ZIP *</label>
                                    <input type="text" value="{{!empty(Auth::user()->postcode) ?Auth::user()->postcode : '' }}" name="postcode" class="form-control" required>
                                </div><!-- End .col-sm-6 -->

                                <div class="col-sm-6">
                                    <label>Phone *</label>
                                    <input type="tel" name="phone" value="{{!empty(Auth::user()->phone) ?Auth::user()->phone : '' }}" class="form-control" required>
                                </div><!-- End .col-sm-6 -->
                            </div><!-- End .row -->

                            <label>Email address *</label>
                            <input type="email" value="{{!empty(Auth::user()->email) ?Auth::user()->email : '' }}" name="email" class="form-control" required>

                            @if(empty(Auth::check()))
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input createAccount" name="is_create" id="checkout-create-acc">
                                <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                            </div><!-- End .custom-checkbox -->

                            <div id="showPassword" style="display: none;">
                                <label>Password *</label>
                                <input id="inputPassword" type="text" name="password" class="form-control" required>
                            </div>
                            @endif

                            <label>Order notes (optional)</label>
                            <textarea class="form-control" name="note" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                        </div><!-- End .col-lg-9 -->
                        <aside class="col-lg-3">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3>

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach(Cart::getContent() as $key => $cart)
                                        @php
                                        $getCartProduct = App\Models\ProductModel::getSingle($cart->id);
                                        @endphp
                                        <tr>
                                            <td><a href="{{url($getCartProduct->slug)}}">{{$getCartProduct->title}}</a></td>
                                            <td>{{number_format($cart->price * $cart->quantity), 2}}</td>
                                        </tr>
                                        @endforeach
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>${{number_format(Cart::getSubTotal(),2)}}</td>
                                        </tr>

                                        <tr>
                                            <td colspan="2">
                                                <div class="cart-discount">
                                                    <div class="input-group">
                                                        <input type="text" name="discount_code" class="form-control" id="getDiscountCode" placeholder="Discount code">
                                                        <div class="input-group-append">
                                                            <button style="height: 38px;" id="ApplyDiscount" type="submit" class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Discount: </td>
                                            <td>$<span id="getDiscountAmount">0.00</span></td>
                                        </tr>

                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        @foreach($getShipping as $shipping)
                                        <tr class="summary-shipping-row">
                                            <td>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" value="{{$shipping->id}}" required data-price="{{!empty($shipping->price) ? $shipping->price : 0}}" id="free-shipping{{$shipping->id}}" name="shipping" class="custom-control-input getShippingCharge">
                                                    <label class="custom-control-label" for="free-shipping{{$shipping->id}}">{{$shipping->name}}</label>
                                                </div>
                                            </td>
                                            <td>
                                                @if(!empty($shipping->name))
                                                ${{number_format($shipping->price), 2}}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach

                                        <tr class="summary-total">
                                            <td>
                                                Total:
                                            </td>
                                            <td>$<span id="getPayableTotal">{{number_format(Cart::getSubTotal(),2)}}</span></td>
                                        </tr><!-- End .summary-total -->
                                    </tbody>
                                </table><!-- End .table table-summary -->
                                <input type="hidden" id="getShippingChargeTotal" value="0">
                                <input type="hidden" id="PayableTotal" value="{{Cart::getSubTotal()}}">
                                <div class="accordion-summary" id="accordion-payment">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" required id="Cashondelivery" value="cash" name="payment_method" class="custom-control-input">
                                        <label class="custom-control-label" for="Cashondelivery">Cash on delivery</label>
                                    </div>

                                    <!-- <div class="custom-control custom-radio" style="margin-top: 0px;">
                                        <input type="radio" required id="PayPal" value="paypal" name="payment_method" class="custom-control-input">
                                        <label class="custom-control-label" for="PayPal">PayPal</label>
                                    </div>

                                    <div class="custom-control custom-radio" style="margin-top: 0px;">
                                        <input type="radio" required id="CreditCard" value="stripe" name="payment_method" class="custom-control-input">
                                        <label class="custom-control-label" for="CreditCard">Credit Card (Stripe)</label>
                                    </div> -->

                                </div><!-- End .accordion -->

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Checkout</span>
                                </button>
                            </div><!-- End .summary -->
                        </aside><!-- End .col-lg-3 -->
                    </div>
                </form>
            </div><!-- End .container -->
        </div><!-- End .checkout -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
@section('script')
<script type="text/javascript">
    $('body').delegate('.createAccount', 'change', function() {
        if(this.checked){
            $('#showPassword').show();
            $('#inputPassword').prop('required', true);
        }
        else{
            $('#showPassword').hide();
            $('#inputPassword').prop('required', false);
        }
    });

    $('body').delegate('#SubmitForm', 'submit', function(e){
        e.preventDefault();
        $.ajax({
           type : "POST",
           url : "{{url('checkout/place_order')}}",
           data : new FormData(this),
           processData : false,
           contentType : false,
           dataType : "json",
           success: function(data){
                if(data.status == false){
                    alert(data.message);
                }
                else{
                    window.location.href = data.redirect;
                }
           },
           error: function(data){

           }
        });
    });

    $('body').delegate('.getShippingCharge', 'change', function() {
        var price = $(this).attr('data-price');
        var total = $('#PayableTotal').val();
        $('#getShippingChargeTotal').val(price);
        var final_total = parseFloat(price) + parseFloat(total);
        $('#getPayableTotal').html(final_total.toFixed(2));
    });

    $('body').delegate('#ApplyDiscount', 'click', function() {
        var discount_code = $('#getDiscountCode').val();
        $.ajax({
            type: "POST",
            url: "{{url('checkout/apply_discount_code')}}",
            data: {
                discount_code: discount_code,
                "_token": "{{csrf_token()}}",
            },
            dataType: "json",
            success: function(data) {
                $('#getDiscountAmount').html(data.discount_amount);
                var shipping = $('#getShippingChargeTotal').val();
                var final_total = parseFloat(shipping) + parseFloat(data.payable_total);

                $('#getPayableTotal').html(final_total.toFixed(2));
                $('#PayableTotal').val(data.payable_total)

                if (data.status == false) {
                    alert(data.message);
                }
            },
            error: function(data) {

            }
        });
    });
</script>
@endsection
