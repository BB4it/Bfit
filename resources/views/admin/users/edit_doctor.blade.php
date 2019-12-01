@extends('admin.layouts.master')

@section('title')
    تعديل بيانات الطبيب
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
                <a href="/admin/user/1">الأطباء</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span> تعديل بيانات الطبيب</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> الأطباء
        <small> تعديل بيانات الطبيب</small>
    </h1>
@endsection

@section('content')


    @if (session('information'))
        <div class="alert alert-success">
            {{ session('information') }}
        </div>
    @endif
    @if (session('pass'))
        <div class="alert alert-success">
            {{ session('pass') }}
        </div>
    @endif
    @if (session('privacy'))
        <div class="alert alert-success">
            {{ session('privacy') }}
        </div>
    @endif

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
                                        <a href="#tab_1_3" data-toggle="tab">تغيير كلمة المرور</a>
                                    </li>
                                    <li>
                                        <a href="#tab_1_4" data-toggle="tab">اعدادات الخصوصية</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!-- PERSONAL INFO TAB -->
                                    <div class="tab-pane active" id="tab_1_1">
                                        <form role="form" action="/admin/update/user/{{$user->id}}/1" method="post" enctype="multipart/form-data">
                                            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>

                                            <div class="form-group">
                                                <label class="control-label">الاسم</label>
                                                <input type="text" name="name" placeholder="الاسم" class="form-control" value="{{$user->name}}" />
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">التخصص</label>
                                                <input type="text" name="specialization" placeholder="التخصص" class="form-control" value="{{$user->specialization}}" />
                                                @if ($errors->has('specialization'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('specialization') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">نسبة الطبيب "النسبة المئوية"</label>
                                                <input type="text" name="percentage" placeholder="نسبة الطبيب" class="form-control" value="{{$user->percentage}}" />
                                                @if ($errors->has('percentage'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('percentage') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">البريد الالكتروني</label>
                                                <input type="text" name="email" placeholder="البريد الالكتروني" class="form-control" value="{{$user->email}}" />
                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">رقم الهاتف</label>
                                                <input type="text" name="phone" placeholder="رقم الهاتف" class="form-control" value="{{$user->phone}}" />
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('phone') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">نبذة عن الطبيب</label>
                                                <input type="text" name="description" placeholder="نبذة عن الطبيب" class="form-control" value="{{$user->description}}" />
                                                @if ($errors->has('description'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">المحفظة</label>
                                                <input type="text" name="wallet" placeholder="المحفظة" class="form-control" value="{{$user->wallet}}" />
                                                @if ($errors->has('wallet'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('wallet') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">الصورة الشخصية</label>
                                                <input type="file" name="image" placeholder="الصورة الشخصية" class="form-control"  />
                                                @if($user->image !== null)
                                                    <a href="{{asset("uploads/users/$user->image")}}" target="_blank">
                                                        <img src="{{asset("uploads/users/$user->image")}}" width="50px" height="50px">
                                                    </a>
                                                @endif
                                                @if ($errors->has('image'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('image') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="gender" class="control-label">اختر الدولة</label>

                                                <div class=" input-group select2-bootstrap-append">
                                                    <select  name="country_id" class="form-control select2-allow-clear" id="country">
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}" {{ $user->country_id == $country->id ? 'selected' : '' }}>{{$country->name_ar}}</option>
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
                                            <div class="form-group" >
                                                <label for="gender" class="control-label">اختر المدينة</label>

                                                <div class=" input-group select2-bootstrap-append">
                                                    <select  name="city_id" class="form-control select2-allow-clear" id="register_city">
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->id}}" {{$user->city_id == $city->id ? 'selected' : '' }}>{{$city->name_ar}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if ($errors->has('city_id'))
                                                        <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('city_id') }}</strong>
                                                            </span>
                                                    @endif
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </button>
                                                    </span>
                                                </div>

                                            </div>


                                            <div class="margiv-top-10">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn green">حفظ</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END PERSONAL INFO TAB -->

                                    <!-- CHANGE PASSWORD TAB -->
                                    <div class="tab-pane" id="tab_1_3">
                                        <form action="/admin/update/pass/{{$user->id}}" method="post">
                                            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>

                                            <div class="form-group">
                                                <label class="control-label">كلمة المرور الجديدة</label>
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
                                            <div class="margin-top-10">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn green">حفظ</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- END CHANGE PASSWORD TAB -->
                                    <!-- PRIVACY SETTINGS TAB -->
                                    <div class="tab-pane" id="tab_1_4">
                                        <form action="/admin/update/privacy/{{$user->id}}" method="post">
                                            <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                                            <table class="table table-light table-hover">

                                                <tr>
                                                    <td> تفعيل المستخدم</td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="active" value="1" {{ $user->active == "1" ? 'checked' : '' }}/> نعم
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="active" value="0" {{$user->active == "0" ? 'checked' : '' }}/> لا
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
                                                <tr>
                                                    <td>هل الطبيب متاح لإستقبال حالات؟</td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="available" value="1" {{ $user->available == "1" ? 'checked' : '' }}/> نعم
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="available" value="0" {{ $user->available == "0" ? 'checked' : '' }}/> لا
                                                                <span></span>
                                                            </label>
                                                            @if ($errors->has('available'))
                                                                <span class="help-block">
                                                                       <strong style="color: red;">{{ $errors->first('available') }}</strong>
                                                                    </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td> تفعيل الإشعارات</td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="notification" value="1" {{$user->notification == "1" ? 'checked' : '' }}/> نعم
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="notification" value="0" {{$user->notification == "0" ? 'checked' : '' }}/> لا
                                                                <span></span>
                                                            </label>
                                                            @if ($errors->has('notification'))
                                                                <span class="help-block">
                                                                       <strong style="color: red;">{{ $errors->first('notification') }}</strong>
                                                                    </span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>

                                            </table>
                                            <div class="margin-top-10">
                                                <div class="form-actions">
                                                    <button type="submit" class="btn green">حفظ</button>

                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                    <!-- END PRIVACY SETTINGS TAB -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PROFILE CONTENT -->
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select[name="address[country]"]').on('change', function() {
                var id = $(this).val();
                $.ajax({
                    url: '/get/cities/'+id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#register_city').empty();



                        $('select[name="address[city]"]').append('<option value>المدينة</option>');
                        // $('select[name="city"]').append('<option value>المدينة</option>');
                        $.each(data['cities'], function(index , cities) {

                            $('select[name="address[city]"]').append('<option value="'+ cities.id +'">'+cities.name+'</option>');

                        });


                    }
                });



            });
        });
    </script>
@endsection