@extends('layouts.app')
@section('content')
<main class="main">
    <div class="intro-section bg-lighter pt-3 pb-6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-slider-container slider-container-ratio slider-container-1 mb-2 mb-lg-0">
                        <div class="intro-slider intro-slider-1 owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl" data-owl-options='{
                                        "nav": false,
                                        "responsive": {
                                            "768": {
                                                "nav": true
                                            }
                                        }
                                    }'>

                            @foreach($getSlider as $slider)
                            @if(!empty($slider->getImage()))
                            <div class="intro-slide">
                                <figure class="slide-image">
                                    <picture>
                                        <source media="(max-width: 480px)" srcset="assets/images/slider/slide-1-480w.jpg">
                                        <img src="{{$slider->getImage()}}" alt="Image Desc">
                                    </picture>
                                </figure><!-- End .slide-image -->

                                <div class="intro-content">
                                    <h1 class="intro-title">{!! $slider->title !!}</h1><!-- End .intro-title -->
                                    @if(!empty($slider->button_link) && !empty($slider->button_name))
                                    <a href="{{$slider->button_link}}" class="btn btn-outline-white">
                                        <span>{{ $slider->button_name }}</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </a>
                                    @endif
                                </div><!-- End .intro-content -->
                            </div><!-- End .intro-slide -->
                            @endif
                            @endforeach

                        </div><!-- End .intro-slider owl-carousel owl-simple -->

                        <span class="slider-loader"></span><!-- End .slider-loader -->
                    </div><!-- End .intro-slider-container -->
                </div><!-- End .col-lg-8 -->

            </div><!-- End .row -->
            @if(!empty($getPartner->count()))
            <div class="mb-6"></div><!-- End .mb-6 -->

            <div class="owl-carousel owl-simple" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": false,
                            "margin": 30,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
                                },
                                "420": {
                                    "items":3
                                },
                                "600": {
                                    "items":4
                                },
                                "900": {
                                    "items":5
                                },
                                "1024": {
                                    "items":6
                                }
                            }
                        }'>
                @foreach($getPartner as $partner)
                <a href="{{!empty($partner->button_link) ? $partner->button_link :"#"}}" class="brand">
                    <img src="{{$partner->getImage()}}">
                </a>
                @endforeach

            </div>
            @endif
        </div><!-- End .container -->
    </div><!-- End .bg-lighter -->

    <div class="mb-6"></div><!-- End .mb-6 -->
    @if(!empty($getProductTrendy->count()))
    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">{{ !empty($getHomeSetting->trendy_product_title) ? $getHomeSetting->trendy_product_title : 'Trendy Products'}}</h2>
        </div>

        <div class="tab-content tab-content-carousel">
            <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" data-owl-options='{
                                "nav": false,
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":4,
                                        "nav": true,
                                        "dots": false
                                    }
                                }
                            }'>

                    @foreach($getProductTrendy as $value)
                    @php
                    $getProductImage = $value->getImageSingle($value->id)
                    @endphp
                    <div class="product product-7 text-center">
                        <figure class="product-media">
                            <a href="{{url($value->slug)}}">
                                @if(!empty($getProductImage) && !empty($getProductImage->getLogo()))
                                <img style="height: 280px;width: 100%;object-fit: cover;" src="{{$getProductImage->getLogo()}}" alt="{{$value->title}}" class="product-image">
                                @endif
                            </a>
                            <!--                    -->
                        </figure>
                        <div class="product-body">
                            <div class="product-cat">
                                <a href="{{url($value->category_slug . '/' . $value->sub_category_slug)}}">{{$value->sub_category_name}}</a>
                            </div>
                            <h3 class="product-title"><a href="{{url($value->title)}}">{{$value->title}}</a></h3>

                            <div class="product-price">
                                {{number_format($value->price, 2)}} VND
                            </div>
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: {{$value->getReviewRating($value->id)}};"></div>
                                    < </div>
                                        <span class="ratings-text">( {{ $value->getTotalReview()}} Reviews )</span>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- @if(!empty($getCategory->count()))
        <div class="container categories pt-6">
            <h2 class="title-lg text-center mb-4">{{ !empty($getHomeSetting->shop_category_title) ? $getHomeSetting->shop_category_title : 'Shop by Categories'}}</h2>

            <div class="row">
                @foreach($getCategory as $category)
                @if(!empty($category->getImage()))
                <div class="col-sm-12 col-lg-4 banners-sm">
                    <div class="banner banner-display banner-link-anim col-lg-12 col-6">
                        <a href="{{url($category->slug)}}">
                            <img style="width: 376px ; height: 230px; object-fit: cover;" src="{{$category->getImage()}}" alt="{{$category->name}}">
                        </a>
                        <div class="banner-content banner-content-center">
                            <h3 class="banner-title text-white"><a href="{{$category->slug}}">{{$category->name}}</a></h3>
                            @if(!empty($category->button_name))
                            <a href="{{$category->slug}}" class="btn btn-outline-white banner-link">{{$category->button_name}}<i class="icon-long-arrow-right"></i></a>
                            @endif
                        </div>
                    </div>

                </div>
                @endif
                @endforeach
            </div>
        </div> -->

        <!-- <div class="mb-5"></div>
        @endif -->


        <div class="container">
            <div class="heading heading-center mb-6">
                <h2 class="title">{{ !empty($getHomeSetting->recent_arrival_title) ? $getHomeSetting->recent_arrival_title : 'Recent Arrivals'}}</h2><!-- End .title -->

                <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                    </li>
                    <!-- @foreach($getCategory as $category)
                    <li class="nav-item">
                        <a class="nav-link getCategoryProduct" data-val="{{$category->id}}" id="top-{{$category->slug}}-link" data-toggle="tab" href="#top-{{$category->slug}}-tab" role="tab" aria-controls="top-{{$category->slug}}-tab" aria-selected="false">{{$category->name}}</a>
                    </li>
                    @endforeach -->
                </ul>
            </div>

            <div class="tab-content">
                <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                    <div class="products">
                        @php
                        $is_home=1;
                        @endphp
                        @include('product._list')
                    </div>
                    <div class="more-container text-center">
                        <a href="{{url('search')}}" class="btn btn-outline-darker btn-more"><span>Load more products</span><i class="icon-long-arrow-down"></i></a>
                    </div>
                </div><!-- End .more-container -->
            </div>
            <!-- @foreach($getCategory as $category)
            <div class="tab-pane p-0 fade getCategoryProduct{{$category->id}}" id="top-{{$category->slug}}-tab" role="tabpanel" aria-labelledby="top-{{$category->slug}}-link">
            </div>
            @endforeach -->
        </div><!-- End .tab-content -->

    </div><!-- End .container -->

    @if(!empty($getBlog->count()))
    <div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
        <div class="container">
            <hr>
            <div class="row justify-content-center">
                @if(!empty($getHomeSetting->payment_delivery_title))
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-card text-center">
                        @if(!empty($getHomeSetting->getPaymentImage()))
                        <span class="icon-box-icon">
                            <img style="width: 100px;" src="{{ $getHomeSetting->getPaymentImage() }}">
                        </span>
                        @endif
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">{{$getHomeSetting->payment_delivery_title}}</h3><!-- End .icon-box-title -->
                            <p>{{$getHomeSetting->payment_delivery_title}}</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->
                @endif

                @if(!empty($getHomeSetting->refund_title))
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-card text-center">
                        @if(!empty($getHomeSetting->getRefundImage()))
                        <span class="icon-box-icon">
                            <img style="width: 100px;" src="{{ $getHomeSetting->getRefundImage() }}">
                        </span>
                        @endif
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">{{$getHomeSetting->refund_title}}</h3><!-- End .icon-box-title -->
                            <p>{{$getHomeSetting->refund_description}}</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->
                @endif

                @if(!empty($getHomeSetting->support_title))
                <div class="col-lg-4 col-sm-6">
                    <div class="icon-box icon-box-card text-center">
                        @if(!empty($getHomeSetting->getSupportImage()))
                        <span class="icon-box-icon">
                            <img style="width: 100px;" src="{{ $getHomeSetting->getSupportImage() }}">
                        </span>
                        @endif
                        <div class="icon-box-content">
                            <h3 class="icon-box-title">{{$getHomeSetting->support_title}}</h3><!-- End .icon-box-title -->
                            <p>{{$getHomeSetting->support_description}}</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                </div><!-- End .col-lg-4 col-sm-6 -->
                @endif
            </div><!-- End .row -->

            <div class="mb-2"></div><!-- End .mb-2 -->
        </div><!-- End .container -->

        @if(!empty($getBlog->count()))
        <div class="blog-posts pt-7 pb-7" style="background-color: #fafafa;">
            <div class="container">
                <h2 class="title-lg text-center mb-3 mb-md-4">{{ !empty($getHomeSetting->blog_title) ? $getHomeSetting->blog_title : 'Our Blog'}}</h2><!-- End .title-lg text-center -->

                <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                    @foreach($getBlog as $blog)
                    <article class="entry entry-display">
                        <figure class="entry-media">
                            <a href="{{url('blog/'.$blog->slug)}}">
                                <img style="height: 260px" src="{{$blog->getImage()}}" alt="{{$blog->title}}">
                            </a>
                        </figure><!-- End .entry-media -->

                        <div class="entry-body pb-4 text-center">
                            <div class="entry-meta">
                                <a href="#">{{ date('M d, Y', strtotime($blog->created_at)) }}</a>, {{$blog->getCommentCount()}} Comments
                            </div><!-- End .entry-meta -->

                            <h3 class="entry-title">
                                <a href="{{url('blog/'.$blog->slug)}}">{{$blog->title}}</a>
                            </h3><!-- End .entry-title -->

                            <div class="entry-content">
                                <p>{{ $blog->short_description }}</p>
                                <a href="{{url('blog/'.$blog->slug)}}" class="read-more">Read More</a>
                            </div><!-- End .entry-content -->
                        </div><!-- End .entry-body -->
                    </article>
                    @endforeach
                </div><!-- End .owl-carousel -->
            </div><!-- container -->

            <div class="more-container text-center mb-0 mt-3">
                <a href="{{url('blog')}}" class="btn btn-outline-darker btn-more"><span>View more articles</span><i class="icon-long-arrow-right"></i></a>
            </div><!-- End .more-container -->
        </div>
        @endif


        @if(!empty($getHomeSetting->singup_title) && empty(Auth::check()))
        <div class="cta cta-display bg-image pt-4 pb-4" style="background-image: url('{{ $getHomeSetting->getSingupImage() }}');">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-9 col-xl-8">
                        <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                            <div class="col">
                                <h3 class="cta-title text-white">{{$getHomeSetting->singup_title}}</h3><!-- End .cta-title -->
                                <p class="cta-desc text-white">{{$getHomeSetting->singup_description}}</p><!-- End .cta-desc -->
                            </div><!-- End .col -->

                            <div class="col-auto">
                                <a href="#signin-modal" data-toggle="modal" class="btn btn-outline-white"><span>SIGN UP</span><i class="icon-long-arrow-right"></i></a>
                            </div><!-- End .col-auto -->
                        </div><!-- End .row no-gutters -->
                    </div><!-- End .col-md-10 col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .cta -->
        @endif
        @endif
</main>
@endsection

@section('script')
<script type="text/javascript">
    $('body').delegate('.getCategoryProduct', 'click', function() {

        var category_id = $(this).attr('data-val');
        console.log(category_id);

        $.ajax({
            url: "{{url('recent_arrival_category_product') }}",
            type: "POST",
            data: {
                "_token": "{{csrf_token()}}",
                category_id: category_id,
            },
            dataType: "json",
            success: function(reponse) {
                $('.getCategoryProduct' + category_id).html(response.success)
            },
        });
    });
</script>
@endsection