@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
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

                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="title" required value="{{old('title', $product->title)}}" placeholder="Title">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>SKU <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="sku" required value="{{old('sku', $product->sku)}}" placeholder="SKU">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category <span style="color: red;">*</span></label>
                                            <select class="form-control" name="category_id">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub Category <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="sub_category_id" required value="{{old('title', $product->sub_category)}}" placeholder="Sub Category">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Brand <span style="color: red;">*</span></label>
                                            <select class="form-control" name="brand_id">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Color <span style="color: red;">*</span></label>
                                            <div>
                                                <label><input type="checkbox" name="color_id[]">Red</label>
                                            </div>
                                            <div>
                                                <label><input type="checkbox" name="color_id[]">White</label>
                                            </div>
                                            <div>
                                                <label><input type="checkbox" name="color_id[]">Green</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price ($)<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="price" required value="" placeholder="Price">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Old Price ($)<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="old_price" required value="" placeholder="Old Price">
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Size <span style="color: red;">*</span></label>
                                            <div>
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Price ($)</th>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary btn-sm">Add</button>
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>

                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-primary btn-sm">Add</button>
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>

                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <input type="text" name="" class="form-control">
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger btn-sm">Delete</button>

                                                            </td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Short description <span style="color: red;">*</span></label>
                                            <textarea class="form-control" name="short_description" placeholder="Short Description"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Description <span style="color: red;">*</span></label>
                                            <textarea class="form-control" name="Description" placeholder=" Description"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Additional Information <span style="color: red;">*</span></label>
                                            <textarea class="form-control" name="additional_information" placeholder="Additional Information"></textarea>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Shipping Returns <span style="color: red;">*</span></label>
                                            <textarea class="form-control" name="shipping_returns" placeholder="Shipping Returns "></textarea>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status <span style="color: red;">*</span></label>
                                            <select class="form-control" name="status" required>
                                                <option {{(old('status')==0) ? 'selected' : ''}} value="0">Active</option>
                                                <option {{(old('status')==1) ? 'selected' : ''}} value="1">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>


                            </div>


                            <hr>

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
<!-- <script src="{{url('assets/dist/js/pages/dashboard3.js')}}"></script> -->
@endsection