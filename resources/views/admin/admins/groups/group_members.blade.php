@extends('admin.layouts.master')

@section('title')
    مجموعات المشرفين
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.bootstrap-rtl.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
@endsection

@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="{{ url('admin/home') }}">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="{{ url('/admin/roles') }}">مجموعات المشرفين</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>مجموعات المشرفين</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title"> جميع الاعضاء
        <small>عرض جميع الأعضاء</small>
    </h1>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <h3 style="margin-top: 0" class="col-md-12">{{ $role->role_name }}</h3>
                            <div class="col-lg-6">
                                {{--<div class="btn-group">--}}
                                {{--<a class="btn sbold green" href="{{ url('/dashboard/add_admin_group/' . $role->id) }}"> إضافة عضو جديد لهذه المجموعة--}}
                                {{--<i class="fa fa-plus"></i>--}}
                                {{--</a>--}}
                                {{--</div>--}}
                            </div>
                            <div class="col-lg-6">
                                <div class="btn-group pull-right">
                                    <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown" aria-expanded="false">أدوات
                                        <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;">
                                                <i class="fa fa-print"></i> طباعة
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                        <thead>
                        <tr>
                            <th>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                    <span></span>
                                </label>
                            </th>

                            <th> الإسم </th>
                            <th> الإيميل </th>
                            <th> الهاتف </th>
                            <th> االصلاحيات </th>
                            <th> تاريخ الاضافة </th>
                            {{-- <th> {{ trans('admin.permissionsIndex') }} </th>--}}
                            <th> العمليات </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach( $data as $value )
                            <tr class="odd gradeX">
                                <td>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" value="1" />
                                        <span></span>
                                    </label>
                                </td>

                                <td class="no_dec"> {{ $value->name }}</td>
                                <td><a href="mailto:{{ $value->email }}"> {{ $value->email }} </a></td>
                                <td><a href="del:{{ $value->phone }}"> {{ $value->phone }} </a></td>
                                <td>
                                    <a href="{{ url('/admin/show_permissions/' . $value->id) }}" class="btn btn-xs green btn-outline">

                                        <i class="fa fa-eye"></i> عرض
                                    </a>
                                </td>
                                <td> {{ $value->created_at }} </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> العمليات
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">
                                            <li>
                                                <a href="{{ url('/admin/admins/' . $value->id . '/edit') }}">
                                                    <i class="fa fa-edit"></i> تعديل
                                                </a>
                                            </li>
                                             @if( auth()->guard('admin')->user()->id  != $value->id )
                                            <li>
                                                <a class="delete_data" data="{{ $value->id }}" data_name="{{ $value->name }}">
                                                    <i class="fa fa-key"></i> حذف
                                                </a>
                                            </li>
                                            @endif
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

            $( document ).ready(function () {
                $('body').on('click', '.delete_data', function() {
                    var id = $(this).attr('data');
                    var swal_text = 'حذف ' + $(this).attr('data_name');
                    var swal_title = 'هل أنت متأكد من الحذف ؟';

                    swal({
                        title: swal_title,
                        text: swal_text,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonClass: "btn-warning",
                        confirmButtonText: "تأكيد",
                        cancelButtonText: "إغلاق"
                    }, function() {

                        window.location.href = "{{ url('/') }}" + "/admin/admin_delete/" + id;

                    });

                });
            });
        });
    </script>
@endsection