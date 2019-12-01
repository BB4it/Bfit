@extends('admin.layouts.master')

@section('title')
    الخدمات
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
                <a href="/admin/services/showServices">الخدمات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الخدمات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الخدمات
        <small>اضافة الخدمات</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/services/add/services" enctype="multipart/form-data" >
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-anchor font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">إضافة الخدمات</span>
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
                                        <input type="text" name="name" class="form-control" placeholder="العنوان" value="{{old('name')}}">
                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="form-body">
                                <div class="form-group ">

                                    <label class="col-md-3 control-label">الايقونة</label>
                                    <div class="col-md-9">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                            </div>
                                            <div>
                                                                <span class="btn red btn-outline btn-file">
                                                                    <span class="fileinput-new"> اختر الصورة  </span>
                                                                    <span class="fileinput-exists"> تغيير </span>
                                                                    <input type="file" name="icon_photo"> </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> إزالة </a>


                                            </div>
                                        </div>

                                    </div>
                                    @if ($errors->has('icon_photo'))
                                        <span class="help-block">
                                           <strong style="color: red;">{{ $errors->first('icon_photo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">حجم الصورة</label>
                                    <div class="col-md-4">
                                        <label>العرض</label>
                                        <input type="text" class="form-control" placeholder="العرض" name="icon_width" value="{{old('icon_width')}}">

                                        @if ($errors->has('icon_width'))
                                            <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('icon_width') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label>الطول</label>
                                        <input type="text" class="form-control" placeholder="الطول" name="icon_height" value="{{old('icon_height')}}">

                                        @if ($errors->has('icon_height'))
                                            <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('icon_height') }}</strong>
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
                                <div class="form-group">
                                    <label class="col-md-3 control-label">حجم الصورة</label>
                                    <div class="col-md-4">
                                        <label>العرض</label>
                                        <input type="text" class="form-control" placeholder="العرض" name="photo_width" value="{{old('photo_width')}}">

                                        @if ($errors->has('photo_width'))
                                            <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('photo_width') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label>الطول</label>
                                        <input type="text" class="form-control" placeholder="الطول" name="photo_height" value="{{old('photo_height')}}">

                                        @if ($errors->has('photo_height'))
                                            <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('photo_height') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">النص المختصر</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control"  rows="3" placeholder="النص" name="small_desc" >{!! old('small_desc') !!}</textarea>
                                        @if ($errors->has('small_desc'))
                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('small_desc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">النص الكبير</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="description2" rows="3" placeholder="النص" name="long_desc" >{!! old('long_desc') !!}</textarea>
                                        @if ($errors->has('long_desc'))
                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('long_desc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
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
    <script src="{{ URL::asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>

        CKEDITOR.replace('description2');
    </script>
@endsection