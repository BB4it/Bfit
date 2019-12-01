@extends('admin.layouts.master')

@section('title')
    تعديل جميع الدورات
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
@endsection


@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="/admin/lectureMedia/{{$user_id}}"> الدورات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الدورات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الدورات
        <small>تعديل جميع الدورات</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/lecturesFiles_status/{{$lectureMedia->id}}" enctype="multipart/form-data"  >
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
                                                    <label for="gender" class="col-md-3 control-label">الحالة </label>
                                                    <div class="col-md-9">
                                                        <div class=" input-group select2-bootstrap-append">
                                                            <select  name="status" class="form-control select2-allow-clear">
                                                                <option value="0" {{$lectureMedia->status == 0? 'selected' : '' }}>قيد المراجعه</option>
                                                                <option value="1" {{$lectureMedia->status == 1? 'selected' : '' }}>فعال</option>
                                                                <option value="2" {{$lectureMedia->status == 2? 'selected' : '' }}>تم الرفض</option>

                                                            </select>

                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                                    <span class="glyphicon glyphicon-search"></span>
                                                                </button>
                                                            </span>
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
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn green">حفظ</button>
                            </div>
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

@endsection
