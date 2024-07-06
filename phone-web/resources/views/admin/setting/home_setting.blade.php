@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Home Setting</h1>
                    </div>

                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    @include('admin.layouts._message')
                        <div class="card card-primary">

                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Trendy Product Title<span style="color: red;">*</span></label>
                                        <input type="text" required class="form-control" value="{{ $getRecord->trendy_product_title }}" name="trendy_product_title">
                                    </div>  
                                    
                                    <div class="form-group">
                                        <label>Shop Category Title<span style="color: red;">*</span></label>
                                        <input type="text" required class="form-control" value="{{ $getRecord->shop_category_title }}" name="shop_category_title">
                                    </div> 

                                    <div class="form-group">
                                        <label>Recent Arrival Title<span style="color: red;">*</span></label>
                                        <input type="text" required class="form-control" value="{{ $getRecord->recent_arrival_title }}" name="recent_arrival_title">
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label>Blog Title<span style="color: red;">*</span></label>
                                        <input type="text" required class="form-control" value="{{ $getRecord->blog_title }}" name="blog_title">
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label>Payment Delivery Title<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->payment_delivery_title }}" name="payment_delivery_title">
                                    </div> 

                                    <div class="form-group">
                                        <label>Payment Delivery Description<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->payment_delivery_description }}" name="payment_delivery_description">
                                    </div> 
                                    
                                    <div class="form-group">
                                        <label>Payment Delivery Image<span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="payment_delivery_image">
                                        @if (!empty($getRecord->getPaymentImage()))
                                            <img src="{{ $getRecord->getPaymentImage() }}" style="width: 50px;">
                                        @endif
                                    </div> 

                                    <hr/>

                                    <div class="form-group">
                                        <label>Refund Title<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->refund_title }}" name="refund_title">
                                    </div> 

                                    <div class="form-group">
                                        <label>Refund Description<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->refund_description }}" name="refund_description">
                                    </div> 

                                    <div class="form-group">
                                        <label>Refund Image<span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="refund_image">
                                        @if (!empty($getRecord->getRefundImage()))
                                            <img src="{{ $getRecord->getRefundImage() }}" style="width: 50px;">
                                        @endif
                                    </div> 

                                    <hr/>

                                    <div class="form-group">
                                        <label>Support Title<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->support_title }}" name="support_title">
                                    </div> 

                                    <div class="form-group">
                                        <label>Support Description<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->support_description }}" name="support_description">
                                    </div> 

                                    <div class="form-group">
                                        <label>Support Image<span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="support_image">
                                        @if (!empty($getRecord->getSupportImage()))
                                            <img src="{{ $getRecord->getSupportImage() }}" style="width: 50px;">
                                        @endif
                                    </div> 

                                    <hr/>

                                    <div class="form-group">
                                        <label>Signup Title<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->singup_title }}" name="singup_title">
                                    </div> 

                                    <div class="form-group">
                                        <label>Signup Description<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->singup_description }}" name="singup_description">
                                    </div> 

                                    <div class="form-group">
                                        <label>Signup Image<span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="singup_image">
                                        @if (!empty($getRecord->getSingupImage()))
                                            <img src="{{ $getRecord->getSingupImage() }}" style="width: 50px;">
                                        @endif
                                    </div>            

                                    
                                </div>
                        
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>

    </div>
@endsection

@section('script')
    <!-- <script src="{{url('assets/dist/js/pages/dashboard3.js')}}"></script> -->
@endsection
