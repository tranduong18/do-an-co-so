@extends('layouts.app')
@section('style')

@endsection
@section('content')
    <main class="main">
        <div class="page-header text-center">
            <div class="container">
                <h1 class="page-title">Notifications</h1>
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
                                <table class="table table-striped">
                                    <tbody>
                                    @foreach($getRecord as $value)
                                    <tr>
                                        <td style="padding: 10px;">
                                            <a style="color: #000; {{empty($value->is_read) ? 'font-weight:bold' : ''}}" href="{{$value->url}}?noti_id={{$value->id}}">
                                                {{$value->message}}
                                            </a>
                                            <div>
                                                <small>
                                                    {{ date('d-m-Y h:i A', strtotime($value->created_at))}}
                                                </small>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
