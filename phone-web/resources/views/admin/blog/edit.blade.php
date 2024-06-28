@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Blog</h1>
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
                                    <label>Title <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="title" required value="{{ $getRecord->title }}" placeholder="Title">
                                    <div style="color:red">{{$errors->first('title')}}</div>
                                </div>

                                <div class="form-group">
                                    <label>Category Name <span style="color: red;">*</span></label>
                                    <select name="blog_category_id" class="form-control" required>
                                        <option value="">Select</option>
                                        @foreach($getCategory as $category)
                                        <option {{ ($getRecord->blog_category_id == $category->id) ? 'selected' : '' }} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Image <span style="color: red;">*</span></label>
                                    <input type="file" class="form-control" name="image_name">
                                    @if(!empty($getRecord->getImage()))
                                        <img src="{{ $getRecord->getImage() }}" style="height: 200px;">
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>Description <span style="color: red;">*</span></label>
                                    <textarea name="description" class="form-control editor">{{$getRecord->description}}</textarea>
                                </div>


                                <div class="form-group">
                                    <label>Status <span style="color: red;">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <option {{($getRecord->status==0) ? 'selected' : ''}} value="0">Active</option>
                                        <option {{($getRecord->status==1) ? 'selected' : ''}} value="1">Inactive</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Meta title <span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="meta_title" required value="{{$getRecord->meta_title}}" placeholder="Meta title">
                                </div>

                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control" placeholder="Meta Description">{{$getRecord->meta_description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Meta Keywords</label>
                                    <input type="text" class="form-control" name="meta_keywords" value="{{$getRecord->meta_keywords}}" placeholder="Meta Keywords">
                                </div>

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