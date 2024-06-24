@extends('layouts.app')
@section('style')
<style type="text/css">
    .box-btn{
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        box-shadow:0 0 1px rgba(0,0,0,.125) ,0 1px 3px rgba(0,0,0,.2) ;
    }
</style>
@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Dashboard</h1>
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
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="box-btn" style="margin-bottom: 20px;">
                                            <div style="font-size: 20px; font-weight: bold;">{{$TotalOrder}}</div>

                                            <div style="font-size: 16px;">Total Order</div>
                                        </div>
                                    </div>


                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{$TotalTodayOrder}}</div>

                                            <div style="font-size: 16px;">Today Order</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{number_format($TotalAmount,2)}}</div>

                                            <div style="font-size: 16px;">Total  Amount</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{number_format($TotalTodayAmount,2)}}</div>

                                            <div style="font-size: 16px;">Today Amount</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{$TotalPending}}</div>

                                            <div style="font-size: 16px;">Pending Order</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{$TotalInProgree}}</div>

                                            <div style="font-size: 16px;">In Progree Order</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{$TotalCompleted}}</div>

                                            <div style="font-size: 16px;">Completed Orders</div>
                                        </div>
                                    </div>

                                    <div class="col-md-3" style="margin-bottom: 20px;">
                                        <div class="box-btn">
                                            <div style="font-size: 20px; font-weight: bold;">{{$TotalCanceled}}</div>

                                            <div style="font-size: 16px;">Canceled Orders</div>
                                        </div>
                                    </div>
                                </div>



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
