@extends('admin.layouts.master')

@section('title')
    المقالات
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
                <a href="/admin/article">المقالات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض المقالات </span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض مقالات
        <small>اضافة جميع المقالات</small>
    </h1>
@endsection

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/add/article" enctype="multipart/form-data" >
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-anchor font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">إضافة مقال</span>
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
                                    <label class="col-md-3 control-label">الاسم</label>
                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control" placeholder="الاسم" value="{{old('title')}}">
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
                            <div class="form-group">
                                <label class="col-md-3 control-label">ملخص المقال</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="3" placeholder="ملخص المقال" name="summary" >{{old('summary')}}</textarea>
                                    @if ($errors->has('summary'))
                                        <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('summary') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">التاريخ</label>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" name="date"value="{{old('date')}}" >
                                    @if ($errors->has('date'))
                                        <span class="help-block">
                                       <strong style="color: red;">{{ $errors->first('date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">التفاصيل</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" id="description2" name="description" >{!! old('text') !!}</textarea>
                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('description') }}</strong>
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