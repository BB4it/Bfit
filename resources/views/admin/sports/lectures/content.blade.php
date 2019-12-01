@extends('admin.layouts.master')

@section('title')
    محتوى المحاضرات
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.bootstrap-rtl.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/dist/basic.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/dist/dropzone.css') }}">
@endsection

@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="/admin/diplomaLectures/{{$lectures->id}}"> المحاضرات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض  محتوى المحاضرات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض محتوى المحاضرات
        <small>عرض جميع  محتوى المحاضرات</small>
    </h1>
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-danger">
            {{ session('msg') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">

                <div class="portlet-body">

                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="btn-group">
                                    <a  href="#" data-toggle="modal" data-target="#myModalFile">
                                        <button id="sample_editable_1_new" class="btn sbold green"> اضافة ملف
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>

                                    <a href="#" data-toggle="modal" data-target="#myModalVideo">
                                        <button id="sample_editable_1_new" class="btn sbold green"> اضافة فيديو
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{--modal for file--}}
                    <div class="modal" id="myModalFile" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!--Modal body -->
                                <div class="modal-body">
                                    <h4>اضافة ملف</h4>
                                    
                                    <form action="/admin/add/diplomaLecturesFiles/{{$id}}" method="post"  enctype="multipart/form-data" >
                                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                                        <div class="form-group">
                                            <input type="text" id="title"  name="title" class="form-control" placeholder="العنوان">
                                        </div>
                                        <div class="form-group">
                                            <input type="file" id="upload_files"  name="upload_files" class="form-control" >
                                        </div>
                                        <div>
                                            <button>اضافة</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--modal for file--}}
                    {{--modal for file--}}
                    <div class="modal" id="myModalVideo" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!--Modal body -->
                                <div class="modal-body">
                                    <h4>اضافة فيديو</h4>
                                    
                                        <form action="/admin/add/diplomaLecturesVideo/{{$id}}"   method="post" id="videoForm"  enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="title"  name="title" class="form-control" placeholder="العنوان" required>
                                            </div>
                                            <div class="form-group ">
                                                
                                                <input type="file" name="file_upload" class="form-control wizard personal-passport" >
                                            </div>
                                            <!-- <input type="submit" name="upload" value="اضافة" class=" btn btn-success" required> -->
                                            <button type="submit">اضافة</button>
                                        </form>

                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                0%
                                            </div>
                                        </div>
                                        <br />
                                        <div id="success">

                                        </div>
                                        <br />

                                </div>
                            </div>
                        </div>
                    </div>
                    {{--modal for file--}}

                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                    <span></span>
                                </label>
                            </th>
                            <th></th>

                            <th> العنوان </th>
                            <th> الحالة </th>
                            <!-- <th> الملف </th> -->




                            <th> خيارات </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0 ?>
                        @foreach($contents as $course)

                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td><?php echo ++$i ?></td>
                                    <td> {!! str_limit($course->title,70)  !!} </td>
                                    <td>
                                        @if($course->status == 0)
                                            قيد المراجعة
                                        @elseif($course->status == 1)
                                            فعال
                                        @elseif($course->status == 2)
                                            تم الرفض
                                        @endif
                                    </td>

                                    <td>

                                        <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> خيارات
                                        <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">

                                        <!-- <li>
                                        <a href="/admin/edit/course/{{$course->id}}">
                                        <i class="icon-docs"></i> تعديل </a>
                                        </li> -->
                                        <li>
                                        <a href="#" data-toggle="modal" data-target="#myModallectureStatus{{$course->id}}">
                                        <i class="icon-docs"></i> تعديل الحالة </a>
                                        </li>

                                        <li>
                                            <a class="delete_bookReview" data="{{$course->id}}" data_name="{{str_limit($course->title,50)}}" >
                                                <i class="fa fa-key"></i> مسح
                                            </a>
                                        </li>


                                        </ul>
                                        </div>


                                    </td>

                                </tr>
                                {{--modal for status--}}
                                    <div class="modal" id="myModallectureStatus{{$course->id}}" role="dialog">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!--Modal body -->
                                                <div class="modal-body">
                                                    <h4>تعديل حالة المحاضرة</h4>
                                                    <form action="/admin/updateDiplomaLecturesFiles_status/{{$course->id}}" method="post"  >
                                                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                                                        <div class="form-group">

                                                            <div class=" input-group select2-bootstrap-append">
                                                                <select  name="status" class="form-control select2-allow-clear">

                                                                    <option value="0" {{$course->status == 0? 'selected' : '' }}>قيد المراجعة</option>
                                                                    <option value="1" {{$course->status == 1? 'selected' : '' }}>فعال</option>
                                                                    <option value="2" {{$course->status == 2? 'selected' : '' }}>تم الرفض</option>

                                                                </select>

                                                            </div>

                                                        </div>


                                                        <button>تعديل</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{--modal for status--}}
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('admin/js/datatable.js') }}"></script>
    <script src="{{ URL::asset('admin/js/datatables.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/datatables.bootstrap.js') }}"></script>
    <script src="{{ URL::asset('admin/js/table-datatables-managed.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/ui-sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/video/dropzone.js') }}"></script>

    <script src="http://malsup.github.com/jquery.form.js"></script>
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="X-CSRF-TOKEN"]').attr('content');

            $('body').on('click', '.delete_bookReview', function() {
                var id = $(this).attr('data');

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

                    window.location.href = "{{ url('/') }}" + "/admin/delete/"+id+"/diplomaLecturesFiles";


                });

            });


            $('#videoForm').ajaxForm({
                beforeSend:function(){
                    $('#success').empty();
                },
                uploadProgress:function(event, position, total, percentComplete)
                {
                    $('.progress-bar').text(percentComplete + '%');
                    $('.progress-bar').css('width', percentComplete + '%');
                },
                success:function(data)
                {
                    if(data.errors)
                    {
                    $('.progress-bar').text('0%');
                    $('.progress-bar').css('width', '0%');
                    $('#success').html('<span class="text-danger"><b>'+data.errors+'</b></span>');
                    }
                    if(data.success)
                    {
                    $('.progress-bar').text('100%');
                    $('.progress-bar').css('width', '100%');
                    $('#success').html('<span class="text-success"><b>'+data.success+'</b></span><br /><br />');
                    $('#success').append(data.file);    

                    }
                    if(data == "1"){
                        // document.location.reload(true);
                        $('#myModalVideo').modal('hide');

                        var swal_title ="تم الاضافة بنجاح";

                            swal({
                                title: swal_title,
                                type: "success",
                                showCancelButton: false,
                                confirmButtonClass: "btn-warning",
                                confirmButtonText: "تأكيد",
                                cancelButtonText: "إغلاق",
                                closeOnConfirm: false
                            }, function() {

                                document.location.reload(true);


                            });
                    }
                    
                }
            });

        });



        // Dropzone.options.myAwesomeDropzone = {
        //     init: function() {
        //         this.on("addedfile", function(file) { alert("Added file."); });
        //     }
        // };


    </script>


@endsection