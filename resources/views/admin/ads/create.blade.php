@extends('admin.layouts.master')

@section('title')
    الاعلانات
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
                <a href="/admin/ads">الاعلانات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الاعلانات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الاعلانات
        <small>اضافة جميع الاعلانات</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/add/ads" enctype="multipart/form-data" >
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-anchor font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">إضافة اعلان</span>
                        </div>

                    </div>
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
                                    <label class="col-md-3 control-label">العنوان</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control" placeholder="العنوان" value="{{old('title')}}">
                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-body">
                                <div class="form-group ">

                                    <label class="col-md-3 control-label">الصورة</label>
                                    <div class="col-md-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                              </div>
                                            <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> اختر الصورة  </span>
                                                                    <span class="fileinput-exists"> تغيير </span>
                                                                    <input type="file" name="photo"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> إزالة </a>


                                            </div>
                                        </div>

                                    </div>
                                    @if ($errors->has('photo'))
                                        <span class="help-block">
                                           <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">اللينك</label>
                                    <div class="col-md-9">
                                        <input type="text" name="link" class="form-control" placeholder="اللينك" value="{{old('link')}}">
                                        @if ($errors->has('link'))
                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('link') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">مكان الاعلان</label>
                                <div class="col-md-9 mt-radio-inline">
                                    <label class="mt-radio">
                                        <input type="radio" name="place" value="1" {{ old('place')== "1" ? 'checked' : '' }}/> الصفحات الداخلية
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="place" value="2" {{ old('place') == "2" ? 'checked' : '' }}/> الصفحة الرئيسية-البانر العريض
                                        <span></span>
                                    </label>
                                    <label class="mt-radio">
                                        <input type="radio" name="place" value="3" {{ old('place') == "3" ? 'checked' : '' }}/> الصفحة الرئيسية-البانر الطويل
                                        <span></span>
                                    </label>
                                    @if ($errors->has('place'))
                                        <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('place') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">حجم الصورة</label>
                                <div class="col-md-4">
                                    <label>العرض</label>
                                    <input type="text" class="form-control" placeholder="العرض" name="width" value="{{old('width')}}">

                                    @if ($errors->has('width'))
                                        <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('width') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label>الطول</label>
                                    <input type="text" class="form-control" placeholder="الطول" name="height" value="{{old('height')}}">

                                    @if ($errors->has('height'))
                                        <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('height') }}</strong>
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
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn green" value="حفظ" onclick="this.disabled=true;this.value='تم الارسال, انتظر...';this.form.submit();">حفظ</button>
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