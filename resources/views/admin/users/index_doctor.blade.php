@extends('admin.layouts.master')

@section('title')
    الأطباء
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
                <a href="/admin/user/1">المستخدمين</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الأطباء</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الأطباء
        <small>عرض جميع الأطباء</small>
    </h1>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
             @endif
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet light bordered">
                <div class="portlet-body">
                    <div class="table-toolbar">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="btn-group">
                                <a class="btn sbold green" href="/admin/add/user/1"> إضافة جديد
                                <i class="fa fa-plus"></i>
                                </a>
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
                            <th></th>
                            <th> الاسم</th>
                            <th> التخصص</th>
                            <th> البريد الالكتروني </th>
                            <th>رقم الهاتف</th>
                            <th>المحفظة</th>
                            <th>التفعيل</th>
                            <th> العمليات </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i=0 ?>
                        @foreach($users as $user)
                            <tr class="odd gradeX">
                                <td>
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" value="1" />
                                        <span></span>
                                    </label>
                                </td>
                                <td><?php echo ++$i ?></td>
                                <td><a href="{{url('admin/doctorDetails/'.$user->id)}}">{{$user->name}}</a></td>
                                <td> {{$user->specialization}} </td>
                                <td> {{$user->email}} </td>
                                <td>{{$user->phone}} </td>
                                <td>{{$user->wallet ? $user->wallet : 0}} <span style="color:blueviolet">ريال</span> </td>

                                @if($user->active == 0)
                                    <td><button type="button" class="btn btn-circle red btn-sm">غير مفعل</button></td>
                                @else
                                    <td><button type="button" class="btn btn-circle blue btn-sm"> مفعل</button></td>
                                @endif


                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> العمليات
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu pull-left" role="menu">
                                            <li>
                                                <a class="empty_wallet" data="{{ $user->id }}" data_name="{{ $user->name }}" data_name2="{{$user->wallet}}" >
                                                    <i class="icon-eye"></i> تصفير المحفظة
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/admin/edit/user/{{$user->id}}/{{$user->type}}">
                                                    <i class="icon-docs"></i> تعديل </a>
                                            </li>
                                            {{--                                            @if( auth()->user()->id != $value->id )--}}
                                            <li>
                                                <a class="delete_user" data="{{ $user->id }}" data_name="{{ $user->name }}"  >
                                                    <i class="fa fa-key"></i> مسح
                                                </a>
                                            </li>

                                            {{--@endif--}}
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

            $('body').on('click', '.delete_user', function() {
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

                    window.location.href = "{{ url('/') }}" + "/admin/delete/"+id+"/user";


                });

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="X-CSRF-TOKEN"]').attr('content');

            $('body').on('click', '.empty_wallet', function() {
                var id = $(this).attr('data');
                var wallet = $(this).attr('data_name2');

                var swal_text = 'تصفير محفظة ' + $(this).attr('data_name') + '؟ ';
                var swal_title = 'المحفظة بها ' +wallet + ' ريال , هل انت متأكد من تصفير هذا المبلغ ؟';

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
                    window.location.href = "{{ url('/') }}" + "/admin/emptyWallet/user/"+id;


                });

            });

        });
    </script>

@endsection