@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Page</h1>
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

                                        <label>Name <span style="color:red;"></span></label>
                                        <input type="text" class="form-control" name="name"  value="{{$getRecord->name}}">
                                    </div>

                                    <div class="form-group">
                                    <label>Title <span style="color:red;"></span></label>
                                        <input type="text" class="form-control" name="title"  value="{{$getRecord->title}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Image <span style="color: red;">*</span></label>
                                        <input type="file" class="form-control" name="image_name" >
                                        @if(!empty($getRecord->getImage()))
                                            <img src="{{$getRecord->getImage()}}" style="height: 100px;">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                    <label>Description <span style="color:red;"></span></label>
                                        <textarea class="form-control editor" name="description">{{$getRecord->description}}</textarea>
                                    </div>
                                    <hr>
                                   

                                 
                                 

                                    <div class="form-group">
                                        <label>Meta title <span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" name="meta_title" required value="{{old('meta_title', $getRecord->meta_title)}}" placeholder="Meta title">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea name="meta_description" class="form-control" placeholder="Meta Description">{{old('meta_description', $getRecord->meta_description)}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Keywords</label>
                                        <input type="text" class="form-control" name="meta_keywords" value="{{old('meta_keywords', $getRecord->meta_keywords)}}" placeholder="Meta Keywords">
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
    <script src="{{url('tinymce/tinymce-jquery.min.js')}}"></script>
    <script type="text/javascript">
   $('.editor').tinymce({
        height: 200,
        menubar: false,
        plugins: [
            'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'markdown',
            'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
            'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
    });
    </script>
@endsection
