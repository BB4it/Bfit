@extends('admin.layouts.master')

@section('title')
    الطلبات
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.bootstrap-rtl.css') }}">
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
                <a href="/admin/orders"> الطلبات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض  الطلبات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الطلبات
        <small>عرض جميع الطلبات</small>
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
                            <th>رقم الطلب </th>
                            <th>البرنامج </th>
                            <th>الدكتور المسئول </th>
                            <th>المريض </th>
                            <th>سعر</th>
                            <th> خيارات </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0 ?>
                        @foreach($orders as $order)

                                <tr class="odd gradeX">
                                    <td>
                                        <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes" value="1" />
                                            <span></span>
                                        </label>
                                    </td>
                                    <td><?php echo ++$i ?></td>

                                    <?php $program = \App\Program::where('id',$order->program_id)->first(); ?>
                                    <td># <a href="{{url('admin/show/order/'.$order->id)}}">{{$order->id}}</a></td>
                                    <td>{{$program->title}}</td>
                                    <?php $doctor = \App\User::where('id',$program->user_id)->first(); ?>
                                    <td><a href="{{url('admin/doctorDetails/'.$doctor->id)}}">{{$doctor->name}}</a></td>
                                    <?php $user = \App\User::where('id',$order->user_id)->first();?>
                                    <td><a href="{{url('admin/userDetails/'.$user->id)}}">{{$user->name}}</a></td>
                                    <td>{{$order->cost}}</td>
                                    <td>

                                        <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> خيارات
                                        <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">

                                        <li>
                                        <a href="/admin/show/order/{{$order->id}}">
                                        <i class="icon-docs"></i> عرض </a>
                                        </li>

                                        <li>
                                            <a class="delete_bookReview" data="{{$order->id}}" data_name="{{str_limit($program->title,50)}}" >
                                                <i class="fa fa-key"></i> مسح
                                            </a>
                                        </li>
                                        </ul>
                                        </div>
                                    </td>

                                </tr>

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
    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="X-CSRF-TOKEN"]').attr('content');

            $('body').on('click', '.delete_bookReview', function() {
                var id = $(this).attr('data');

                var swal_text = 'حذف طلب ' + $(this).attr('data_name') + '؟';
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

                    window.location.href = "{{ url('/') }}" + "/admin/delete/"+id+"/order";


                });

            });

        });
    </script>



@endsection