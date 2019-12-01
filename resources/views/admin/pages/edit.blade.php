@extends('admin.layouts.master')

@section('title')
    تعديل بيانات الصفحة
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
                <a href="/admin/setting/pages">الصفحات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الصفحات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الصفحات
        <small>تعديل بيانات الصفحة</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/page/{{$page->id}}" >
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>


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
                                                    <input type="text" name="title" class="form-control" placeholder="الاسم" value="{{$page->title}}">
                                                    @if ($errors->has('title'))
                                                        <span class="help-block">
                                                                               <strong style="color: red;">{{ $errors->first('title') }}</strong>
                                                                            </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="facebook" class="col-lg-3 control-label">المحتوى</label>
                                            <div class="col-lg-9">
                                                {{--<input id="facebook" name="terms" value="{{ $data->terms }}" type="text" class="form-control" placeholder="{{ $data->terms }}">--}}
                                                <textarea id="description2" name="text" class="form-control">{!! $page->text!!}</textarea>
                                                @if ($errors->has('text'))
                                                    <span class="help-block">
                                                           <strong style="color: red;">{{ $errors->first('text') }}</strong>
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
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script src="{{ URL::asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>

        CKEDITOR.replace('description2');
    </script>




@endsection
