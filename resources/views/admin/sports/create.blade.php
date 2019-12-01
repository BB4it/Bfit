@extends('admin.layouts.master')

@section('title')
    الأنشطة الرياضية
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
@endsection


@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="/admin/sports"> الأنشطة الرياضية</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض  الأنشطة الرياضية</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض  الأنشطة الرياضية
        <small>اضافة جميع الأنشطة الرياضية</small>
    </h1>
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-danger">
            {{ session('msg') }}
        </div>
    @endif
    @if(count($errors))
        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    @endif
    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/add/sport" enctype="multipart/form-data" >
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-anchor font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">إضافة نشاط جديد</span>
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
                                    <label for="gender" class="col-md-3 control-label">النشاط الرياضى </label>
                                    <div class="col-md-9">
                                        <div class=" input-group select2-bootstrap-append">
                                            <select  name="type" class="form-control select2-allow-clear">

                                                <option value="goals" {{old('type') == "goals"? 'selected' : '' }}> الهدف من الإشتراك </option>
                                                <option value="levels" {{old('type') == "levels"? 'selected' : '' }}>مستوى النشاط الرياضى</option>
                                                <option value="types" {{old('type') == "types"? 'selected' : '' }}> نوع النشاط الرياضى</option>
                                                <option value="fats" {{old('type') == "fats"? 'selected' : '' }}>أكثر المناطق تحتوى على دهون </option>
                                                <option value="fats" {{old('type') == "fats"? 'selected' : '' }}>أكثر المناطق تحتوى على دهون </option>

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
                                    <label class="col-md-3 control-label">نوع النشاط <span class="red">*</span></label>
                                    <div class="col-md-9">
                                    <input type="text" class="form-control" name="text" placeholder="نوع النشاط" value="{{old('text')}}">
                                    </div>
                                </div>

                            </div>


                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green" value="حفظ" onclick="this.disabled=true;this.value='تم الارسال, انتظر...';this.form.submit();">حفظ</button>
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
            </form>
            <!-- END TAB PORTLET-->





        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script src=" {{ URL::asset('admin/js/jquery.repeater.js') }}" type="text/javascript"></script>

    <script src=" {{ URL::asset('admin/js/form-repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('select[name="diploma_type"]').on('change', function() {
            var stateID = $(this).val();
            if (stateID == "1") {
                $('#diploma_price').append('<label class="col-md-3 control-label">سعر الدبلومة</label><div class="col-md-9"><input class="form-control" type="text" name="diploma_price" id="diploma_price" placeholder="سعر الدبلومة" value= "'+ "{{old('diploma_price')}}"+'"></div>');

            }else{
                $('#diploma_price').empty();


            }

        });



    });
    function myFunction() {
        // Get the checkbox
        var checkBox = document.getElementById("myCheck");
        // Get the output text
        var text = document.getElementById("text");

        // If the checkbox is checked, display the output text
        if (checkBox.checked == true){
            $('#show_certificate').append('<label class="col-md-3 control-label"></label><div class="col-md-9"><div class="col-md-3"><input type="radio" name="certificate_type" value="1">' +
                '<span>شهادة ورقية</span></div><div class="col-md-3"><input type="radio" name="certificate_type" value="2"><span>شهادة الكترونية</span></div>' +
                '<div class="col-md-3"><input type="radio" name="certificate_type" value="3"><span>معا</span></div></div>');
        } else {
            $('#show_certificate').empty();
        }
    }
</script>

@endsection