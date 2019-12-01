@extends('admin.layouts.master')

@section('title')
    اضافة ادمن
@endsection

@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="/admin/user/admin">الادمن</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>اضافة ادمن</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> الادمن
        <small>اضافة ادمن</small>
    </h1>
@endsection

@section('content')



    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">

            <!-- BEGIN PROFILE CONTENT -->
            <div class="profile-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light ">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">حساب الملف الشخصي</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab_1_1" data-toggle="tab">المعلومات الشخصية</a>
                                    </li>

                                    <li>
                                        <a href="#tab_1_4" data-toggle="tab">اعدادات الخصوصية</a>
                                    </li>
                                </ul>
                            </div>
                            <form role="form" action="/admin/add/admin" method="post">
                                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                                <div class="portlet-body">

                                    <div class="tab-content">
                                        <!-- PERSONAL INFO TAB -->
                                        <div class="tab-pane active" id="tab_1_1">


                                            <div class="form-group">
                                                <label class="control-label">الاسم</label>
                                                <input type="text" name="name" placeholder="الاسم" class="form-control" value="{{old('name')}}" />
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">البريد الالكتروني</label>
                                                <input type="text" name="email" placeholder="البريد الالكتروني" class="form-control" value="{{old('email')}}" />
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">كلمة المرور</label>
                                                <input type="password" name="password" class="form-control" />
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">إعادة كلمة المرور</label>
                                                <input type="password" name="password_confirmation" class="form-control" />
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>





                                        </div>
                                        <!-- END PERSONAL INFO TAB -->


                                        <!-- PRIVACY SETTINGS TAB -->
                                        <div class="tab-pane" id="tab_1_4">

                                            <table class="table table-light table-hover">

                                                <tr>
                                                    <td> تفعيل المستخدم</td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="active" value="1" {{ old('active') == "1" ? 'checked' : '' }}/> نعم
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="active" value="0" {{ old('active') == "0" ? 'checked' : '' }}/> لا
                                                                <span></span>
                                                            </label>
                                                            @if ($errors->has('active'))
                                                                <span class="help-block">
                                                                       <strong style="color: red;">{{ $errors->first('active') }}</strong>
                                                                    </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>


                                            </table>


                                        </div>
                                        <!-- END PRIVACY SETTINGS TAB -->
                                    </div>

                                </div>
                                <div class="margiv-top-10">
                                    <div class="form-actions">
                                        <button type="submit" class="btn green">حفظ</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>

@endsection