@extends('layouts.app')
@section('style')

@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Orders Details</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->


        <div class="page-content">
            <div class="dashboard">
                <div class="container">
                    <br>
                    <br>

                    <div class="row">
                        @include('user._sidebar')
                        <div class="col-md-8 col-lg-9">
                            <div class="tab-content">
                                <div class="">

                                    <div class="form-group">
                                        <label>Name : <span style="font-weight: normal;">{{$getRecord->last_name}} {{$getRecord->first_name}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Address : <span style="font-weight: normal;">{{$getRecord->address_one}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Postcode : <span style="font-weight: normal;">{{$getRecord->postcode}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone : <span style="font-weight: normal;">{{$getRecord->phone}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Email : <span style="font-weight: normal;">{{$getRecord->email}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Discount Code : <span style="font-weight: normal;">{{$getRecord->discount_code}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Discount Amount ($) : <span style="font-weight: normal;">{{number_format($getRecord->discount_amount, 2)}}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Shipping Amount ($) : <span style="font-weight: normal;">{{number_format($getRecord->shipping_amount, 2)}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Amount ($) : <span style="font-weight: normal;">{{number_format($getRecord->total_amount, 2)}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Status : @if($getRecord -> status ==0)
                                                Pending
                                            @elseif($getRecord -> status ==1)
                                                In Progress
                                            @elseif($getRecord -> status ==2)
                                                Delivered
                                            @elseif($getRecord -> status ==3)
                                                Completed
                                            @elseif($getRecord -> status ==4)
                                                Canceled
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Note : <span style="font-weight: normal;">{{$getRecord->note}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Created Date : <span style="font-weight: normal;">{{ date('d-m-Y', strtotime($getRecord->created_at))}}</span></label>
                                    </div>
                                </div>

                            </div>
                            <div class="card">
                                <div class="card-header" style="margin-top:20px;">
                                    <h3 class="card-title">Product Details</h3>
                                </div>
                                <div class="card-body p-0" style="overflow: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Size Amount ($)</th>
                                            <th>Total Amount ($)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getRecord->getItem as $item)
                                            @php
                                                $getProductImage = $item->getProduct->getImageSingle($item->getProduct->id);
                                            @endphp
                                            <tr>
                                                <td>
                                                    <img style="width: 100px; height: 100px" src="{{$getProductImage->getLogo()}}" >
                                                </td>
                                                <td><a target="_blank" href="{{url($item->getProduct->slug)}}">{{$item->getProduct->title}}</a>
                                                <br>
                                                Color Name: {{$item->color_name}}<br/>
                                                Size: {{$item->size_name}}<br/>
                                                </td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->price}}</td>

                                                <td>{{number_format($item->size_amount, 2)}}</td>
                                                <td>{{number_format($item->total_price, 2)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection

@section('script')

@endsection
