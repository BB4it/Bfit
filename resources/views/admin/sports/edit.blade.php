@extends('admin.layouts.master')

@section('title')
    تعديل جميع الأنشطة الرياضية
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">

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
                <a href="/admin/sports"> الأنشطة الرياضية</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الأنشطة الرياضية</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الأنشطة الرياضية
        <small>تعديل جميع الأنشطة الرياضية</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/sport/{{$sport->id}}" enctype="multipart/form-data"  >
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
                                                    <label for="gender" class="col-md-3 control-label">النشاط الرياضى </label>
                                                    <div class="col-md-9">
                                                        <div class=" input-group select2-bootstrap-append">
                                                            <select  name="type" class="form-control select2-allow-clear">

                                                                <option value="goals" {{$sport->type == "goals"? 'selected' : '' }}> الهدف من الإشتراك </option>
                                                                <option value="levels"{{$sport->type == "levels"? 'selected' : '' }}>مستوى النشاط الرياضى</option>
                                                                <option value="types" {{$sport->type == "types"? 'selected' : '' }}> نوع النشاط الرياضى</option>
                                                                <option value="fats" {{$sport->type == "fats"? 'selected' : '' }}>أكثر المناطق تحتوى على دهون </option>

                                                            </select>

                                                            <span class="input-group-btn">
                                                                <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                                    <span class="glyphicon glyphicon-search"></span>
                                                                </button>
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">نوع النشاط <span class="red">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control"  name="text" placeholder="نوع النشاط" value="{{$sport->text}}">
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
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script src=" {{ URL::asset('admin/js/jquery.repeater.js') }}" type="text/javascript"></script>
    <script src=" {{ URL::asset('admin/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
    <script src=" {{ URL::asset('admin/js/form-repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>

@endsection
