@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Notification</h1>
                </div>

            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.layouts._message')


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Notification</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">

                                <tbody>
                                    @foreach($getRecord as $value)
                                    <tr>
                                        <td>
                                            <a style="color: #000; {{empty($value->is_read) ? 'font-weight:bold' : ''}}" href="{{$value->url}}?noti_id={{$value->id}}">
                                                {{$value->message}}
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="padding: 10px; float: right;">
                                {!!$getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links()!!}

                            </div>
                        </div>

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