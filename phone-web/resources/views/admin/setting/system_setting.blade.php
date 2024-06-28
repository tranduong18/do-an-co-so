@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>System Setting</h1>
                    </div>

                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    @include('admin.layouts._message')
                        <div class="card card-primary">

                            <form action="" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Website<span style="color: red;">*</span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->website_name }}" name="website_name">
                                    </div>

                                    <div class="form-group">
                                        <label>Logo<span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="logo">
                                        @if (!empty($getRecord->getLogo()))
                                        <img src="{{ $getRecord->getLogo() }}" style="width: 50px;">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Fevicon<span style="color: red;"></span></label>
                                        <input type="file" class="form-control" name="fevicon">
                                        @if (!empty($getRecord->getFevicon()))
                                        <img src="{{ $getRecord->getFevicon() }}" style="width: 50px;">
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Footer Description<span style="color: red;"></span></label>
                                        <textarea name="footer_description" class="form-control">{{ $getRecord->footer_description }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Footer Payment Icon<span style="color: red;"></span></label>
                                        <textarea type="file" name="footer_payment_icon" class="form-control"></textarea>
                                        @if (!empty($getRecord->getFooterPayment()))
                                        <img src="{{ $getRecord->getFooterPayment() }}" style="width: 200px;">
                                        @endif
                                    </div>

                                    <hr />

                                    <div class="form-group">
                                        <label>Address<span style="color: red;"></span></label>
                                        <textarea name="address" class="form-control">{{ $getRecord->address }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Phone<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->phone }}" name="phone">
                                    </div>

                                    <div class="form-group">
                                        <label>Phone 2<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->phone_two }}" name="phone_two">
                                    </div>

                                    <div class="form-group">
                                        <label>Submit Contact Email<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->submit_email }}" name="submit_email">
                                    </div>

                                    <div class="form-group">
                                        <label>Email<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->email }}" name="email">
                                    </div>

                                    <div class="form-group">
                                        <label>Email 2<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->email_two }}" name="email_two">
                                    </div>

                                    <div class="form-group">
                                        <label>Working Hour<span style="color: red;"></span></label>
                                        <textarea name="working_hour" class="form-control">{{ $getRecord->working_hour }}</textarea>
                                    </div>

                                    <hr>
                                    
                                    <div class="form-group">
                                        <label>Facebook link<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->facebook_link }}" name="facebook_link">
                                    </div>

                                    <div class="form-group">
                                        <label>Twitter link<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->twitter_link }}" name="twitter_link">
                                    </div>

                                    <div class="form-group">
                                        <label>Instagram link<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->instagram_link }}" name="instagram_link">
                                    </div>

                                    <div class="form-group">
                                        <label>Youtube link<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->youtube_link }}" name="youtube_link">
                                    </div>

                                    <div class="form-group">
                                        <label>Pinterest link<span style="color: red;"></span></label>
                                        <input type="text" class="form-control" value="{{ $getRecord->pinterest_link }}" name="pinterest_link">
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
    <!-- <script src="{{url('assets/dist/js/pages/dashboard3.js')}}"></script> -->
@endsection
