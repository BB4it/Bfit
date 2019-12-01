@extends('admin.layouts.master')

@section('title')
    المشرفين
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.bootstrap-rtl.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
@endsection

@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('admin/home') }}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ route('admins.index') }}">المشرفين</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض المشرفين</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض المشرفين
        <small>اضافة مشرف</small>
    </h1>
@endsection

@section('content')

    @if(session()->has('msg'))

        <p class="alert alert-success" style="width: 100%">

            {{ session()->get('msg') }}

        </p>
    @endif

    <form class="form-horizontal" method="post" action="{{ url('/dashboard/add_admin') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="role_id" value="{!! $id !!}">

        <div class="row">
            <div class="col-lg-8">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase"> البيانات الرئيسية</span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="btn-group"></div>

                        <div class="form-group">
                            <label class="control-label col-lg-3">الصورة الشخصية</label>
                            <div class="col-lg-9">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 330px; height: 150px;">
                                    </div>
                                    <div>
                                            <span class="btn red btn-outline btn-file">
                                                <span class="fileinput-new"> اختر صورة </span>
                                                <span class="fileinput-exists"> تغيير </span>
                                                <input type="file" name="photo" accept="image/*">
                                            </span>
                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> حذف </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-lg-3 control-label">الاسم</label>
                            <div class="col-lg-9">
                                <input id="username" name="name" type="text" class="form-control" placeholder="الاسم">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-lg-3 control-label">الايميل</label>
                            <div class="col-lg-9">
                                <input id="email" name="email" type="email" class="form-control" placeholder="الايميل">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-lg-3 control-label">الرقم السرى</label>
                            <div class="col-lg-9">
                                <input id="password" name="password" type="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirm" class="col-lg-3 control-label">اعد كتابة الرقم السرى</label>
                            <div class="col-lg-9">
                                <input id="password_confirm" name="password_confirm" type="password" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone" class="col-lg-3 control-label">الهاتف</label>
                            <div class="col-lg-9">
                                <input id="phone" name="phone" type="text" class="form-control" placeholder="الهاتف">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender" class="col-lg-3 control-label">النوع</label>
                            <div class="col-lg-9">
                                <div class="input-group select2-bootstrap-append">
                                    <select id="gender" name="gender" class="form-control select2-allow-clear" required>
                                        <option value selected> </option>
                                        <option value="M">ذكر</option>
                                        <option value="F">أنثى</option>
                                    </select>
                                    <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                <span class="glyphicon glyphicon-search"></span>
                                            </button>
                                        </span>
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label for="role" class="col-lg-3 control-label">إضافة إلى مجموعة</label>--}}
                            {{--<div class="col-lg-9">--}}
                                {{--<div class="input-group select2-bootstrap-append">--}}
                                    {{--<select id="role" name="role" class="form-control select2-allow-clear" required>--}}
                                        {{--<option value selected> </option>--}}
                                        {{--@foreach($data as $value)--}}
                                            {{--<option value="{{ $value->id }}">{{ $value->role_name }}</option>--}}
                                        {{--@endforeach--}}
                                    {{--</select>--}}
                                    {{--<span class="input-group-btn">--}}
                                            {{--<button class="btn btn-default" type="button" data-select2-open="single-append-text">--}}
                                                {{--<span class="glyphicon glyphicon-search"></span>--}}
                                            {{--</button>--}}
                                        {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div style="clear: both"></div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-10">
                                    {{--<button type="submit" class="btn green btn-block">حفظ</button>--}}
                                    <input class="btn green btn-block" type="submit" value="حفظ" onclick="this.disabled=true;this.value='تم الارسال, انتظر...';this.form.submit();" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

    {{--{!! Form::close() !!}--}}
@endsection

@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
@endsection

