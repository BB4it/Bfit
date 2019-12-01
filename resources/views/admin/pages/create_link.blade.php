@extends('admin.layouts.master')

@section('title')
    إضافة بيانات الروابط
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
                <a href="/admin/setting/pageLinks">الروابط</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الروابط</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الروابط
        <small>إضافة بيانات الروابط</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8 ">
            <!-- BEGIN SAMPLE FORM PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body form">
                    <form class="form-horizontal" role="form" action="/admin/add/link" method="post">
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <div class="form-body">

                            <div class="form-group">
                                <label for="gender" class="col-md-3 control-label">اختر الصفحة</label>
                                <div class="col-lg-9">
                                    <div class=" input-group select2-bootstrap-append">
                                        <select id="gender" name="page" class="form-control select2-allow-clear">

                                            @foreach($pages as $page)
                                                <option value="{{$page->id}}" {{ old('page') == $page->id ? 'selected' : '' }}>{{$page->title}}</option>
                                            @endforeach

                                        </select>
                                        @if ($errors->has('page'))
                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('page') }}</strong>
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
                                <label class="col-md-3 control-label">المكان</label>
                                <div class="col-md-9">
                                    <div class="mt-radio-inline">
                                        <label class="mt-radio">
                                            <input type="radio" name="place"  value="header" {{ old('place') == "header" ? 'checked' : '' }}> أعلى الصفحة
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="place"  value="footer" {{ old('place') == "footer" ? 'checked' : '' }}> أسفل الصفحة
                                            <span></span>
                                        </label>
                                        <label class="mt-radio">
                                            <input type="radio" name="place"  value="both" {{ old('place') == "both" ? 'checked' : '' }}> معا
                                            <span></span>
                                        </label>

                                    </div>
                                    @if ($errors->has('place'))
                                        <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('place') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ترتيب العرض</label>
                                    <div class="col-md-9">
                                        <input type="text" name="order" class="form-control" placeholder="ترتيب العرض" value="{{old('order')}}">
                                        @if ($errors->has('order'))
                                            <span class="help-block">
                                                   <strong style="color: red;">{{ $errors->first('order') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn green" value="حفظ" onclick="this.disabled=true;this.value='تم الارسال, انتظر...';this.form.submit();">حفظ</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END SAMPLE FORM PORTLET-->

        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
@endsection