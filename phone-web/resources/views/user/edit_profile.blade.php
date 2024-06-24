@extends('layouts.app')
@section('style')

@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Edit profile</h1>
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
                                @include('layouts._message')
                                <form action=""  method="post">
                                    {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>First Name *</label>
                                        <input type="text" name="first_name" value="{{$getRecord->name}}" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Last Name *</label>
                                        <input type="text" value="{{$getRecord->last_name}}"  name="last_name" class="form-control" required>
                                    </div>
                                </div><!-- End .row -->

                                <label>Company Name (Optional)</label>
                                <input type="text" value="{{$getRecord->company_name}}"  name="company_name" class="form-control">

                                <label>Country *</label>
                                <input type="text" value="{{$getRecord->country}}"  name="country" class="form-control" required>

                                <label>Address *</label>
                                <input type="text" value="{{$getRecord->address_one}}"  name="address_one" class="form-control" placeholder="" required>
                                <!-- <input type="text" name="address_two" class="form-control" placeholder="Appartments, suite, unit etc ..." required> -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Town / City *</label>
                                        <input type="text" value="{{$getRecord->city}}"  name="city" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <!-- <div class="col-sm-6">
                                        <label>State *</label>
                                        <input type="text" name="state" class="form-control" required>
                                    </div> -->
                                </div><!-- End .row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Postcode / ZIP *</label>
                                        <input type="text" value="{{$getRecord->postcode}}"  name="postcode" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->

                                    <div class="col-sm-6">
                                        <label>Phone *</label>
                                        <input type="tel" value="{{$getRecord->phone}}"  name="phone" class="form-control" required>
                                    </div><!-- End .col-sm-6 -->
                                </div><!-- End .row -->

                                <label>Email address *</label>
                                <input type="email" value="{{$getRecord->email}}"  name="email" class="form-control" required>
                                <button type="submit" style="width: 100px;" class="btn btn-outline-primary-2 btn-order btn-block">
                                    Submit
                                </button>
                                </form>
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
