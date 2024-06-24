@extends('layouts.app')
@section('style')
<link rel="stylesheet" href="{{url('assets/css/plugins/owl-carousel/owl.carousel.css')}}">
<link rel="stylesheet" href="{{url('assets/css/plugins/magnific-popup/magnific-popup.css')}}">
<link rel="stylesheet" href="{{url('assets/css/plugins/nouislider/nouislider.css')}}">
<style type="text/css">
    .active-color {
        border: 3px solid #000 !important;
    }
</style>
@endsection
@section('content')
<main class="main">
    <div class="page-header text-center" style="background-image: url('{{ url('')}}/assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Wishlist</h1>
        </div>
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="javascript:;">My Wishlist</a></li>
            </ol>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('product._list')
                </div>
                <div class="col-lg-12">
                    {!! $getProduct->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                </div>
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->
</main><!-- End .main -->

@endsection
@section('script')
@endsection