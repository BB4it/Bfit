@extends('admin.layouts.master')

@section('title')
    اضافة مستخدم
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
                <span>اضافة مستخدم</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> الأطباء
        <small>اضافة طبيب</small>
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
                            <form role="form" action="/admin/add/user/1" method="post" enctype="multipart/form-data">
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
                                                <label class="control-label">التخصص</label>
                                                <input type="text" name="specialization" placeholder="التخصص" class="form-control" value="{{old('specialization')}}" />
                                                @if ($errors->has('specialization'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('specialization') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">نسبة الطبيب "النسبة المئوية"</label>
                                                <input type="text" name="percentage" placeholder="نسبة الطبيب" class="form-control" value="{{old('percentage')}}" />
                                                @if ($errors->has('percentage'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('percentage') }}</strong>
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
                                                <label class="control-label">رقم الهاتف</label>
                                                <input type="text" name="phone" placeholder="رقم الهاتف" class="form-control" value="{{old('phone')}}" />
                                                @if ($errors->has('phone'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('phone') }}</strong>
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
                                            <div class="form-group">
                                                <label class="control-label">نبذة عن الطبيب</label>
                                                <input type="text" name="description" placeholder="نبذة عن الطبيب" class="form-control" value="{{old('description')}}" />
                                                @if ($errors->has('description'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('description') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">المحفظة</label>
                                                <input type="text" name="wallet" placeholder="المحفظة" class="form-control" value="{{old('wallet')}}" />
                                                @if ($errors->has('wallet'))
                                                    <span class="help-block">
                                                       <strong style="color: red;">{{ $errors->first('wallet') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">الصورة الشخصية للطبيب</label>
                                                <input type="file" name="image" placeholder="الصورة الشخصية للطبيب" class="form-control"  />

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
                                                            <option value="{{$country->id}}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{$country->name_ar}}</option>
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
                                                            <option value="{{$city->id}}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{$city->name_ar}}</option>
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
                                                <tr>
                                                    <td>هل الطبيب متاح لإستقبال حالات؟</td>
                                                    <td>
                                                        <div class="mt-radio-inline">
                                                            <label class="mt-radio">
                                                                <input type="radio" name="available" value="1" {{ old('available') == "1" ? 'checked' : '' }}/> نعم
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="available" value="0" {{ old('available') == "0" ? 'checked' : '' }}/> لا
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
                                                                <input type="radio" name="notification" value="1" {{ old('notification') == "1" ? 'checked' : '' }}/> نعم
                                                                <span></span>
                                                            </label>
                                                            <label class="mt-radio">
                                                                <input type="radio" name="notification" value="0" {{ old('notification') == "0" ? 'checked' : '' }}/> لا
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


                                        </div>
                                        <!-- END PRIVACY SETTINGS TAB -->


                                    </div>

                                </div>
                                <div class="margiv-top-10">
                                    <div class="form-actions">
                                        <button type="submit" class="btn green" value="حفظ" onclick="this.disabled=true;this.value='تم الارسال, انتظر...';this.form.submit();">حفظ</button>

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
@section('scripts')
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select[name="country_id"]').on('change', function() {
                var id = $(this).val();
                // console.log(id);
                $.ajax({
                    url: '/admin/get/cities/'+id,
                    type: "GET",
                    dataType: "json",
                    success:function(data) {
                        $('#register_city').empty();

                        $('select[name="city_id"]').append('<option value>المدينة</option>');
                        // $('select[name="city"]').append('<option value>المدينة</option>');
                        $.each(data['cities'], function(index , cities) {

                            $('select[name="city_id"]').append('<option value="'+ cities.id +'">'+cities.name_ar+'</option>');

                        });


                    }
                });



            });
        });
    </script>
@endsection