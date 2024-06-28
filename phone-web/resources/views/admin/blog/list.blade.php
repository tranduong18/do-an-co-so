@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Blog List</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{url('admin/blog/add')}}" class="btn btn-primary">Add New Blog</a>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts._message')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Blog List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Meta Title</th>
                                        <th>Meta Description</th>
                                        <th>Meta Keywords</th>
                                        <th>Status</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>
                                            @if(!empty($value->getImage()))
                                                <img src="{{$value->getImage()}}" style="height: 100px;">
                                            @endif
                                        </td>
                                        <td>{{$value->title}}</td>
                                        <td>{{$value->meta_title}}</td>
                                        <td>{{$value->meta_description}}</td>
                                        <td>{{$value->meta_keywords}}</td>
                                        <td>{{($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ date('d-m-Y', strtotime($value->created_at))}}</td>
                                        <td>
                                            <a href="{{url('admin/blog/edit/'.$value->id)}}" class="btn btn-primary">Edit </a>
                                            <a onclick="return confirm('Are you want to delete?');" href="{{url('admin/blog/delete/'.$value->id)}}" class="btn btn-danger">Delete </a>
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
<!-- <script src="{{url('assets/dist/js/pages/dashboard3.js')}}"></script> -->
@endsection
