@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
<div class="content-wrapper">
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add New Color</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
              <form action="" method="post">
                    {{ csrf_field() }}
                <div class="card-body">
                  <div class="form-group">
                    <label>Color Name <span style="color: red;">*</span> </label>
                    <input type="text" class="form-control" name="name" required value="{{old('name')}}" placeholder="Color name">
                  </div>
                  
                  <div class="form-group">
                    <label>Color code <span style="color: red;">*</span> </label>
                    <input type="color" class="form-control" name="code" required value="{{old('code')}}" placeholder="Color code">
                  </div>

                  <div class="form-group">
                    <label>Slug <span style="color: red;">*</span></label>
                    <input type="text" class="form-control" name="slug" required value="{{old('slug')}}" placeholder="Slug">
                    <div style="color:red">{{$errors->first('slug')}}</div>
                  </div>

                  <div class="form-group">
                    <label>Status <span style="color: red;">*</span></label>
                    <select class="form-control" name="status" required>
                        <option {{(old('status')==0) ? 'selected' : ''}} value="0">Active</option>
                        <option {{(old('status')==1) ? 'selected' : ''}} value="1">Inactive</option>
                    </select>
                  </div>

                  <hr>

              
            
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