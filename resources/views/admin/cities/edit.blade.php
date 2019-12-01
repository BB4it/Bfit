@extends('admin.layouts.master')

@section('title')
    تعديل جميع المدن
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
                <a href="/admin/city">المدن</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض المدن</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض المدن
        <small>تعديل جميع المدن</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/city/{{$city->id}}" enctype="multipart/form-data">
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <div class="portlet light bordered">

                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <div class="row">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-body form">
                                    <div class="form-horizontal" role="form">

                                        <div class="form-group">
                                            <label for="gender" class="col-md-3 control-label">اختر الدولة</label>
                                            <div class="col-lg-9">
                                                <div class=" input-group select2-bootstrap-append">
                                                    <select id="gender" name="country_id" class="form-control select2-allow-clear">
                                                        @foreach($countries as $country)
                                                                <option value="{{$country->id}}" {{ $city->country_id == $country->id ? 'selected' : '' }}>{{$country->name_ar}}</option>
                                                        @endforeach

                                                    </select>
                                                    @if ($errors->has('country_id'))
                                                        <span class="help-block">
                                           <strong style="color: red;">{{ $errors->first('country_id') }}</strong>
                                        </span>
                                                    @endif
                                                    <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                    <span class="glyphicon glyphicon-search"></span>
                                                </button>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">الاسم</label>
                                            <div class="col-md-9">
                                                <input type="text" name="name_ar" class="form-control" placeholder="الاسم" value="{{$city->name_ar}}">
                                                @if ($errors->has('name_ar'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('name_ar') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">الكود</label>
                                            <div class="col-md-9">
                                                <input type="text" name="code" class="form-control" placeholder="الكود" value="{{$city->code}}">
                                                @if ($errors->has('code'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('code') }}</strong>
                                                    </span>
                                                @endif
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
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
@endsection