@extends('admin.layouts.master')

@section('title')
   ارسال اشعار للمستخدمين
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
                <a href="{{ url('admin/home') }}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>ارسال اشعار للمستخدمين</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> ارسال اشعار للمستخدمين
        <small>إرسال إشعارات جديدة</small>
    </h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form role="form" action="/admin/notifications/{{$type}}" method="post" enctype="multipart/form-data">
        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
    <div class="row">
        <div class="col-lg-8">
            <div class="portlet light bordered">
                <div class="portlet-body form">
                   <div class="form-horizontal">
                    <div class="form-group">
                        <label for="user" class="col-lg-3 control-label">اسم المستخدم</label>
                        <div class="col-lg-9">
                            <div class="input-group select2-bootstrap-append">
                                <select id="user" name="user" class="form-control select2-allow-clear">
                                    <option value ></option>
                                        <option value="user">جميع العملاء</option>
                                        <option value="doctor"> جميع الاطباء </option>
                                        @foreach( $users as $id => $name)
                                            <option value="{{ $id }}" >{{ $name }}</option>
                                        @endforeach
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
                        <label for="message" class="col-lg-3 control-label">نص الرسالة</label>
                        <div class="col-lg-9">
                            <textarea id="message" name="message" class="form-control autosizeme" rows="10" placeholder="نص الرسالة"></textarea>
                        </div>
                    </div>
                   </div>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-lg-2 col-lg-offset-10">
                                <button type="submit" class="btn green btn-block">حفظ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </form>
@endsection

@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
@endsection
