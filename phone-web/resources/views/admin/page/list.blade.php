@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Page List</h1>
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
                            <h3 class="card-title">Page List</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>                      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($getRecord as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->name}}</td>                     
                                        <td>
                                            <a href="{{url('admin/page/edit/'.$value->id)}}" class="btn btn-primary">Edit </a>
                                        
                                        </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            <div style="padding: 10px; float: right">
                             
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