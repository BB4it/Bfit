@extends('admin.layouts.master')

@section('title')
    تعديل جميع  ملخصات الكتب
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
@endsection


@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="/admin/bookReview"> ملخصات الكتب</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض  ملخصات الكتب</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض  ملخصات الكتب
        <small>تعديل جميع  ملخصات الكتب</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/program/{{$program->id}}" enctype="multipart/form-data"  >
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
                                                        <input type="text" class="form-control" placeholder="العنوان" name="title" value="{{$program->title}}">
                                                        @if ($errors->has('title'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('title') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">السعر</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" placeholder="السعر بالريال" name="price" value="{{$program->price}}" >
                                                        @if ($errors->has('price'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('price') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">المدة</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="period" value="{{old('period')}}" style="height:36px">
                                                            <option value="1" {{$program->period == 1? 'selected' : '' }}>شهر</option>
                                                            <option value="2" {{$program->period == 2? 'selected' : '' }}>شهرين</option>
                                                            <option value="3" {{$program->period == 3? 'selected' : '' }}>ثلاثة أشهر</option>
                                                        </select>
                                                        @if ($errors->has('period'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('period') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">الدكتور المسؤل</label>
                                                    <div class="col-md-9">
                                                        <?php $doctors = \App\User::where('type',1)->where('available',1)->get(); ?>
                                                        <select class="form-control" name="user_id" style="height:36px">
                                                            @foreach($doctors as $doctor)
                                                                <option value="{{$doctor->id}}" {{$program->user_id == $doctor->id? 'selected' : '' }}>{{$doctor->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('user_id'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('user_id') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group ">

                                                    <label class="col-md-3 control-label">الصورة</label>
                                                    <div class="col-md-9">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                                @if($program->image !==null)
                                                                    <img   src='{{ asset("uploads/programs/$program->image") }}'>
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
                                                    @if ($errors->has('photo'))
                                                        <span class="help-block">
                                                           <strong style="color: red;">{{ $errors->first('photo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>


                                            <div class="form-group">
                                                <label for="facebook" class="col-lg-3 control-label">المحتوى</label>
                                                <div class="col-lg-9">
                                                    {{--<input id="facebook" name="terms" value="{{ $data->terms }}" type="text" class="form-control" placeholder="{{ $data->terms }}">--}}
                                                    <textarea id="description2" name="description" class="form-control">{!! $program->description !!}</textarea>
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
    <script src=" {{ URL::asset('admin/js/jquery.repeater.js') }}" type="text/javascript"></script>

    <script src=" {{ URL::asset('admin/js/form-repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/ui-sweetalert.min.js') }}"></script>
    <script>

        CKEDITOR.replace('description2');
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="X-CSRF-TOKEN"]').attr('content');

            $('body').on('click', '.delete_pdf_file', function() {
                // var id = $(this).attr('data');
                var id_pdf = $(this).attr('data');
                var id_bookReview = $(this).attr('data_sub');
                var swal_text = 'حذف ' + $(this).attr('data_name') + '؟';
                var swal_title = 'هل أنت متأكد من الحذف ؟';

                swal({
                    title: swal_title,
                    text: swal_text,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "تأكيد",
                    cancelButtonText: "إغلاق",
                    closeOnConfirm: false
                }, function() {

                    window.location.href = "{{ url('/') }}" + "/admin/delete/"+id_pdf +'/'+id_bookReview+"/BookReview/pdf";


                });

            });

        });

    </script>


@endsection
