@extends('admin.layouts.master')

@section('title')
    المحاضرات
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.bootstrap-rtl.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
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
                <a href="/admin/diploma"> الدبلومات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض  المحاضرات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض  المحاضرات
        <small>عرض جميع  المحاضرات</small>
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
                                        <button id="sample_editable_1_new" class="btn sbold green"> اضافة محاضرة
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
                                    <h4>اضافة محاضرة</h4>
                                    <form action="/admin/add/diplomaLectures/{{$diploma->id}}" method="post"  >
                                        <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                                        <div class="form-group">
                                                <input type="text" name="title" class="form-control" placeholder="العنوان">
                                        </div>


                                        <button>اضافة</button>
                                    </form>

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
                            <th> المحتوى </th>
                            <th> الإمتحانات </th>

                            <th> خيارات </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0 ?>
                        @foreach($lectures as $lecture)

                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td><?php echo ++$i ?></td>
                                    <td> {!! str_limit($lecture->title,70)  !!} </td>
                                    <td>
                                        @if($lecture->status == 0)
                                            قيد المراجعة
                                        @elseif($lecture->status == 1)
                                            فعال
                                        @elseif($lecture->status == 2)
                                            تم الرفض
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/admin/diplomaLecturesFiles/{{$lecture->id}}" class="btn btn-sm blue">
                                            <i class="icon-eye"></i> عرض المحتوى</a>

                                    </td>
                                    
                                    <td>
                                        <a href="{{url('admin/diplomaLectures/'.$lecture->id.'/Exams')}}" class="btn btn-sm blue">
                                            <i class="icon-eye"></i> عرض الإمتحانات</a>
                                    </td>

                                    <td>

                                        <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> خيارات
                                        <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">

                                        <li>
                                        <a href="#" data-toggle="modal" data-target="#myModallecture{{$lecture->id}}">
                                        <i class="icon-docs"></i> تعديل </a>



                                        </li>
                                        <li>
                                        <a href="#" data-toggle="modal" data-target="#myModallectureStatus{{$lecture->id}}">
                                        <i class="icon-docs"></i> تعديل الحالة </a>
                                        </li>

                                        <li>
                                            <a class="delete_bookReview" data="{{$lecture->id}}" data_name="{{str_limit($lecture->title,50)}}" >
                                                <i class="fa fa-key"></i> مسح
                                            </a>
                                        </li>


                                        </ul>
                                        </div>


                                    </td>

                                </tr>

                                {{--modal for title--}}
                                <div class="modal" id="myModallecture{{$lecture->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!--Modal body -->
                                            <div class="modal-body">
                                                <h4>تعديل محاضرة</h4>
                                                <form action="/admin/update/diplomaLectures/{{$lecture->id}}" method="post"  >
                                                    <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                                                    <div class="form-group">
                                                        <input type="text" name="title" class="form-control" placeholder="العنوان" value="{{$lecture->title}}">
                                                    </div>


                                                    <button>تعديل</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--modal for title--}}
                                {{--modal for status--}}
                                <div class="modal" id="myModallectureStatus{{$lecture->id}}" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!--Modal body -->
                                            <div class="modal-body">
                                                <h4>تعديل حالة المحاضرة</h4>
                                                <form action="/admin/update/diplomaLecturesStatus/{{$lecture->id}}" method="post"  >
                                                    <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                                                    <div class="form-group">

                                                        <div class=" input-group select2-bootstrap-append">
                                                            <select  name="status" class="form-control select2-allow-clear">

                                                                <option value="0" {{$lecture->status == 0? 'selected' : '' }}>قيد المراجعة</option>
                                                                <option value="1" {{$lecture->status == 1? 'selected' : '' }}>فعال</option>
                                                                <option value="2" {{$lecture->status == 2? 'selected' : '' }}>تم الرفض</option>

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
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
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

                    window.location.href = "{{ url('/') }}" + "/admin/delete/"+id+"/diplomaLectures";


                });

            });

        });
    </script>



@endsection