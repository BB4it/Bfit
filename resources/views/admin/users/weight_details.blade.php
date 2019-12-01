@extends('admin.layouts.master')

@section('title')
    الاوزان
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
                <span>عرض  الاوزان</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الاوزان
        <small>عرض جميع الاوزان</small>
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


                <table class="table table-striped table-bordered table-hover table-checkable order-column" >
                    <thead>
                    <tr>
                        <th>
                            <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" />
                                <span></span>
                            </label>
                        </th>
                        <th></th>

                        <th> اسم المستخدم </th>
                        <th> الوزن </th>
                        <th> التاريخ  </th>



                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0 ?>
                    @foreach($data as $value)

                        <tr class="odd gradeX">
                            <td>
                                <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                    <input type="checkbox" class="checkboxes" value="1" />
                                    <span></span>
                                </label>
                            </td>
                            <td><?php echo ++$i ?></td>
                            <td> <a href="{{url('admin/userDetails/'.$value->user_id)}}">{{\App\User::find($value->user_id)->name}} </a></td>
                            <td>
                                {{$value->weight}}
                            </td>

                            <td>{{$value->date}}</td>



                        </tr>

                    @endforeach
                    </tbody>
                </table>
            </div>
            {!! $data->render() !!}
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
    </div>

@endsection

