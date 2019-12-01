@extends('admin.layouts.master')

@section('title')
    تفعيل الرسائل
@endsection


@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="/admin/setting/activeSms">تفعيل الرسائل</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>تعديل تفعيل الرسائل</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> تفعيل الرسائل
        <small>تعديل تفعيل الرسائل</small>
    </h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PORTLET-->
            <div class="portlet light form-fit bordered">

                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    <form action="/admin/add/activeSms" class="form-horizontal form-bordered" enctype="multipart/form-data" method="post">
                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 control-label">المسار</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="المسار" name="url" value="{{$settings->url}}">
                                    @if ($errors->has('url'))
                                        <span class="help-block">
                                           <strong style="color: red;">{{ $errors->first('url') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اسم المستخدم</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="اسم المستخدم" name="username" value="{{$settings->username}}">
                                    @if ($errors->has('username'))
                                        <span class="help-block">
                                           <strong style="color: red;">{{ $errors->first('username') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">كلمة المرور</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" placeholder="كلمة المرور" name="password" value="{{$settings->password}}">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                           <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">اسم المرسل</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="اسم المرسل" name="sender" value="{{$settings->sender}}">
                                    @if ($errors->has('sender'))
                                        <span class="help-block">
                                           <strong style="color: red;">{{ $errors->first('sender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">تفعيل الرسائل</label>
                            <div class="col-md-9 mt-radio-inline">
                                <label class="mt-radio">
                                    <input type="radio" name="active" value="1" {{ $settings->active_sms == "1" ? 'checked' : '' }}/> نعم
                                    <span></span>
                                </label>
                                <label class="mt-radio">
                                    <input type="radio" name="active" value="0" {{ $settings->active_sms == "0" ? 'checked' : '' }}/> لا
                                    <span></span>
                                </label>
                                @if ($errors->has('active'))
                                    <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('active') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">حفظ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END FORM-->
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>

@endsection

