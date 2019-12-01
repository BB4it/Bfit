@extends('admin.layouts.master')

@section('title')
    تعديل جميع الدول
@endsection
@section('styles')
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
                <a href="/admin/country">الدول</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الدول</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الدول
        <small>تعديل جميع الدول</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/country/{{$country->id}}" enctype="multipart/form-data"  >
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
                                                        <input type="text" name="name_ar" class="form-control" placeholder="الاسم" value="{{$country->name_ar}}">
                                                        @if ($errors->has('name_ar'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('name_ar') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">الحالة</label>
                                                    <div class="col-md-9">

                                                        <select name="status" class="form-control"  style="height: 37px">
                                                            <option value="1">ظاهر</option>
                                                            <option value="0">مخفى</option>
                                                        </select>
                                                        @if ($errors->has('status'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('status') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">كود الدولة</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="code" disabled class="form-control" placeholder="كود الدولة" value="{{$country->code}}">
                                                        @if ($errors->has('code'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('code') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group ">

                                                <label class="col-md-3 control-label">ايقونه علم الدولة</label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="fileinput-preview thumbnail" data-trigger="fileinput" >
                                                            <img  src="{{$country->flag}}">
                                                        </div>

                                                    </div>

                                                </div>
                                                @if ($errors->has('photo_flag'))
                                                    <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('photo_flag') }}</strong>
                                                            </span>
                                                @endif
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

@endsection
