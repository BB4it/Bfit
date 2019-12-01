@extends('admin.layouts.master')

@section('title')
    تعديل جميع الاسلايدر
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
                <a href="/admin/slider">الاسلايدر</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الاسلايدر</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الاسلايدر
        <small>تعديل جميع الاسلايدر</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/slider/{{$slider->id}}" enctype="multipart/form-data"  >
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
                                                    <label class="col-md-3 control-label">العنوان</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="title" class="form-control" placeholder="العنوان" value="{{$slider->title}}">
                                                        @if ($errors->has('title'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('title') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">الترتيب حسب الظهور</label>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control"  name="order" value="{{$slider->order}}" >
                                                        @if ($errors->has('order'))
                                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('order') }}</strong>
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
                                                                @if($slider->image !==null)
                                                                    <img   src='{{ asset("uploads/sliders/$slider->image") }}'>
                                                                @endif
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
                                                    @if ($errors->has('file_upload'))
                                                        <span class="help-block">
                                           <strong style="color: red;">{{ $errors->first('file_upload') }}</strong>
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
