@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Partner</h1>
                    </div>

                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">

                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">


                                    <div class="form-group">
                                        <label>Image <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="image_name" >
                                        @if(!empty($getRecord->getImage()))
                                            <img src="{{$getRecord->getImage()}}" style="height: 100px;">
                                        @endif
                                    </div>



                                    <div class="form-group">
                                        <label>Link <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="button_link" required value="{{$getRecord->button_link}}" placeholder=" Link">
                                    </div>
                                    <div class="form-group">
                                        <label >Status <span style="color: red;">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option {{(old('status')==0) ? 'selected' : ''}} value="0">Active</option>
                                            <option {{(old('status')==1) ? 'selected' : ''}} value="1">Inactive</option>
                                        </select>
                                    </div>

                                    <hr>

                                </div>


                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
