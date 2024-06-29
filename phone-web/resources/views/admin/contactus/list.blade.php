@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Contact Us</h1>
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
                                <h3 class="card-title">Contact Us Search</h3>
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
                                            <label>Name</label>
                                            <input type="text" name="name" placeholder="Name" class="form-control" value="{{Request::get('name')}}">
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
                                            <label>Email</label>
                                            <input type="text" name="phone" placeholder="Phone  " class="form-control" value="{{Request::get('phone')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Subject</label>
                                            <input type="text" style="padding: 6px" name="subject" placeholder="Subject" class="form-control" value="{{Request::get('subject')}}">
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
                                        <a href="{{url('admin/contactus')}}" class="btn btn-primary">Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Contact Us</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Login Name</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Message</th>
                                        <th>Created Date</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{!empty($value->getUser) ? $value->getUser->name : ''}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->phone}}</td>
                                        <td>{{$value->subject}}</td>
                                        <td>{{$value->message}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td>
                                            <a onclick="return confirm('Are you want to delete?');" href="{{url('admin/contactus/delete/'.$value->id)}}" class="btn btn-danger">Delete </a>
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            <div style="padding: 10px; float: right;">
                                {!!$getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links()!!}

                            </div>
                        </div>

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