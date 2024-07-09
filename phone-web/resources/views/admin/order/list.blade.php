@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders List (Total : {{ $getRecord->total() }})</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts._message')

                    <form action="" method="get">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Search</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <label>ID</label>
                                            <input type="text" name="id" placeholder="ID" class="form-control" value="{{Request::get('id')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" placeholder="First Name" class="form-control" value="{{Request::get('first_name')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" placeholder="Last Name" class="form-control" value="{{Request::get('last_name')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" placeholder="Email" class="form-control" value="{{Request::get('email')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Postcode</label>
                                            <input type="text" name="postcode" placeholder="Postcode" class="form-control" value="{{Request::get('postcode')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <input type="date" style="padding: 6px" name="from_date" placeholder="From Date" class="form-control" value="{{Request::get('from_date')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <input type="date" style="padding: 6px" name="to_date" placeholder="To Date" class="form-control" value="{{Request::get('to_date')}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-primary">Search</button>
                                        <a href="{{url('admin/order/list')}}" class="btn btn-primary">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Postcode</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Discount Code</th>
                                        <th>Discount Amount (VND)</th>
                                        <th>Shipping Amount (VND)</th>
                                        <th>Total Amount (VND)</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->last_name}} {{$value->first_name}} </td>
                                        <td>{{$value->address_one}}</td>
                                        <td>{{$value->postcode}}</td>
                                        <td>{{$value->phone}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->discount_code}}</td>
                                        <td>{{number_format($value->discount_amount, 2)}}</td>
                                        <td>{{number_format($value->shipping_amount, 2)}}</td>
                                        <td>{{number_format($value->total_amount, 2)}}</td>
                                        <td>{{$value->payment_method}}</td>
                                        <td>
                                            <select class="form-control ChangeStatus" id="{{$value->id}}" style="width: 150px;">
                                                <option {{($value->status == 0) ? 'selected' : ''}} value="0">Đang xử lý</option>
                                                <option {{($value->status == 1) ? 'selected' : ''}} value="1">Chờ lấy hàng</option>
                                                <option {{($value->status == 2) ? 'selected' : ''}} value="2">Đang giao hàng</option>
                                                <option {{($value->status == 3) ? 'selected' : ''}} value="3">Giao thành công</option>
                                                <option {{($value->status == 4) ? 'selected' : ''}} value="4">Hoãn</option>
                                            </select>
                                        </td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at))}}</td>
                                        <td>
                                            <a href="{{url('admin/order/detail/'.$value->id)}}" class="btn btn-primary">Detail </a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </section>

</div>
@endsection

@section('script')
<script type="text/javascript">
    $('body').delegate('.ChangeStatus', 'change', function(){
        var status = $(this).val();
        var order_id = $(this).attr('id');
        $.ajax({
           type : "GET",
           url : "{{url('admin/order_status')}}",
           data :{
            status : status,
            order_id : order_id
           },
           dataType : "json",
           success: function(data){
                alert(data.message);
           }
        });
    })
</script>
@endsection