@extends('layouts.app')
@section('style')

@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Orders Details</h1>
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
                                <div class="">

                                    <div class="form-group">
                                        <label>Name : <span style="font-weight: normal;">{{$getRecord->last_name}} {{$getRecord->first_name}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Address : <span style="font-weight: normal;">{{$getRecord->address_one}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Postcode : <span style="font-weight: normal;">{{$getRecord->postcode}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone : <span style="font-weight: normal;">{{$getRecord->phone}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Email : <span style="font-weight: normal;">{{$getRecord->email}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Discount Code : <span style="font-weight: normal;">{{$getRecord->discount_code}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Discount Amount ($) : <span style="font-weight: normal;">{{number_format($getRecord->discount_amount, 2)}}</span></label>
                                    </div>

                                    <div class="form-group">
                                        <label>Shipping Amount ($) : <span style="font-weight: normal;">{{number_format($getRecord->shipping_amount, 2)}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Amount ($) : <span style="font-weight: normal;">{{number_format($getRecord->total_amount, 2)}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Status : @if($getRecord -> status ==0)
                                                Pending
                                            @elseif($getRecord -> status ==1)
                                                In Progress
                                            @elseif($getRecord -> status ==2)
                                                Delivered
                                            @elseif($getRecord -> status ==3)
                                                Completed
                                            @elseif($getRecord -> status ==4)
                                                Canceled
                                            @endif
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label>Note : <span style="font-weight: normal;">{{$getRecord->note}}</span></label>
                                    </div>
                                    <div class="form-group">
                                        <label>Created Date : <span style="font-weight: normal;">{{ date('d-m-Y', strtotime($getRecord->created_at))}}</span></label>
                                    </div>
                                </div>

                            </div>
                            <div class="card">
                                <div class="card-header" style="margin-top:20px;">
                                    <h3 class="card-title">Product Details</h3>
                                </div>
                                <div class="card-body p-0" style="overflow: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>QTY</th>
                                            <th>Price</th>
                                            <th>Size Amount ($)</th>
                                            <th>Total Amount ($)</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($getRecord->getItem as $item)
                                            @php
                                                $getProductImage = $item->getProduct->getImageSingle($item->getProduct->id);
                                            @endphp
                                            <tr>
                                                <td>
                                                    <img style="width: 100px; height: 100px" src="{{$getProductImage->getLogo()}}" >
                                                </td>
                                                <td style="max-width: 250px;"><a target="_blank" href="{{url($item->getProduct->slug)}}">{{$item->getProduct->title}}</a>
                                                <br>
                                                @if (!empty($item->color_name))
                                                <b>Color Name: </b>{{$item->color_name}}<br/>
                                                @endif
                                                @if (!empty($item->size_name))
                                                <b>Size: </b>{{$item->size_name}}<br/>
                                                <br>
                                                @endif
                                                @if ($getRecord->status == 3)   
                                                    @php
                                                        $getReview = $item->getReview($item->getProduct->id, $getRecord->id);
                                                    @endphp
                                                    
                                                    @if (!empty($getReview))
                                                        <b>Rating:</b> {{$getReview->rating}} <br>
                                                        <b>Review:</b> {{$getReview->review}} <br>
                                                    @else
                                                    <button class="btn btn-primary MakeReview" id="{{ $item->getProduct->id }}" data-order="{{ $getRecord->id }}">Make Review</button>
                                                    @endif
                                                @endif
                                                </td>
                                                <td>{{$item->quantity}}</td>
                                                <td>{{$item->price}}</td>

                                                <td>{{number_format($item->size_amount, 2)}}</td>
                                                <td>{{number_format($item->total_price, 2)}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div><!-- End .col-lg-9 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .dashboard -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->


<!-- Modal -->
<div class="modal fade" id="MakeReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Make Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('user/make-review') }}" method="post">
        {{csrf_field()}}
        <input type="text" name="product_id" required id="getProductId">
        <input type="text" name="order_id" required id="getOrderId">
      <div class="modal-body" style="padding: 20px;">
        <div class="form-group" style="margin-bottom: 15px;">
            <label>How many rating? *</label>
            <select class="form-control" required name="rating">
                <option value="">Select</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
        </div>

        <div class="form-group">
            <label> Review</label>
            <textarea class="form-control" required name="review"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $('body').delegate('.MakeReview', 'click', function(){
            var product_id = $(this).attr('id');
            var order_id = $(this).attr('data-order');
            $('#getProductId').val(product_id);
            $('#getOrderId').val(order_id);
            $('#MakeReviewModal').modal('show');
        });
    </script>
@endsection
