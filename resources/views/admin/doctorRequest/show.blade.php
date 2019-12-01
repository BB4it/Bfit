@extends('admin.layouts.master')

@section('title')
    عرض طلب انضمام الطبيب
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
@endsection


@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="/admin/doctorRequest">طلبات انضمام الأطباء</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span> عرض طلب انضمام الطبيب</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">    عرض طلب انضمام الطبيب
        <small>عرض طلب انضمام الطبيب</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" >
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <div class="portlet light bordered">

                    <div class="portlet-body">

                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->

                            <div class="row">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-body form">
                                        <div class="form-horizontal" role="form">

                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">الاسم</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" disabled class="form-control" value="{{$request->name}}">
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">البريد الإلكترونى</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="email" disabled class="form-control" value="{{$request->email}}">
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">رقم الهاتف</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="phone" disabled class="form-control" value="{{$request->phone}}">
                                                        @if ($errors->has('phone'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('phone') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">التخصص</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="spcializtion" disabled class="form-control" value="{{$request->spcializtion}}">
                                                        @if ($errors->has('spcializtion'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('spcializtion') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->


                            </div>


                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->


                    </div>
                </div>

            </form>
            <!-- END TAB PORTLET-->





        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script src="{{ URL::asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>

        CKEDITOR.replace('description2');
    </script>
@endsection
