@extends('layouts.app')
@section('style')

@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Orders</h1>
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
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>

                                        <th>Total Amount ($)</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($getOrders as $value)
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td>{{number_format($value->total_amount, 2)}}</td>
                                            <td>
                                                @if($value -> status ==0)
                                                    Pending
                                                @elseif($value -> status ==1)
                                                    In Progress
                                                @elseif($value -> status ==2)
                                                    Delivered
                                                @elseif($value -> status ==3)
                                                    Completed
                                                @elseif($value -> status ==4)
                                                Canceled
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($value->created_at))}}</td>
                                            <td>
                                                <a href="{{url('user/orders/detail/'.$value->id)}}" class="btn btn-primary">Detail </a>
                                            </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
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
