@extends('admin.layouts.master')

@section('title')
    الاسئلة الشائعة
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
                <a href="/admin/setting">اعدادات الموقع</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span> الاسئلة الشائعة </span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> الاسئلة الشائعة
        {{--<small>اضافة جميع المقالات</small>--}}
    </h1>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
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
            <form method="post" action="/admin/add/questionAnswer" enctype="multipart/form-data" >
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-anchor font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase"> الاسئلة الشائعة</span>
                        </div>

                    </div>
                    <div class="portlet-body">

                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->

                            <div class="row">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="form-group mt-repeater">
                                    <div data-repeater-list="faq">
                                        <?php $faq= \App\Q_A::find(1); ?>
                                        @foreach(unserialize($faq->q_a) as $data)
                                        <div data-repeater-item class="row">
                                            <div class="col-md-7">
                                                <label for="">السؤال <span style="color: red">*</span></label>

                                                <div class=" input-group select2-bootstrap-append">

                                                    <input type="text" class="form-control wizard"  placeholder="السؤال" name="name[question]"  value="{{$data['question']}}" >
                                                    <span class="input-group-btn">
                                                            <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                                <span class="glyphicon glyphicon-search"></span>
                                                            </button>
                                                        </span>
                                                </div>

                                            </div>
                                            <div class="col-md-7">
                                                <label for="">الإجابة <span style="color: red">*</span></label>
                                                <input type="text" class="form-control wizard" placeholder="الإجابة" name="name[answer]"  value="{{$data['answer']}}" >
                                            </div>
                                            <div class="col-md-1">
                                                <label class="control-label">&nbsp;</label>
                                                <a href="javascript:;" data-repeater-delete class="btn btn-danger">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <a href="javascript:;" data-repeater-create class="btn btn-info mt-repeater-add">
                                        <i class="fa fa-plus"></i> أضف سؤال جديد</a>
                                    <br>
                                    <br>
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
    <script src=" {{ URL::asset('admin/js/jquery.repeater.js') }}" type="text/javascript"></script>

    <script src=" {{ URL::asset('admin/js/form-repeater.min.js') }}" type="text/javascript"></script>

@endsection