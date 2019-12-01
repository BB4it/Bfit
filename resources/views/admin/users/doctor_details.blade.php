@extends('admin.layouts.master')

@section('title')
    تفاصيل الطبيب
@endsection
@section('styles')

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <style>
        .img-center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
        }
    </style>
@endsection

@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
               الاطباء
                <i class="fa fa-circle"></i>
            </li>

        </ul>
    </div>

    <h1 class="page-title"> الأطباء

    </h1>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
              تفاصيل الطبيب
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-9">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle img-center" src="{{$data->image ? asset('uploads/users/'.$data->image) : asset('admin/img/user.png')}}" alt="User profile picture">

                            <h3 class="profile-username text-center">{{$data->name}}</h3>

                            <p class="text-muted text-center">{{$data->specialization}}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>عدد الطلبات الجارية</b> <a class="pull-right">{{$current_order}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>عدد الطلبات المنتهية</b> <a class="pull-right">{{$end_order}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b> جميع الطلبات</b> <a class="pull-right">{{$all_order}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b> عدد البرامج</b> <a class="pull-right">{{$programs}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b> المحفظة</b> <a class="pull-right">{{$data->wallet}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b> نسبة الطبيب</b> <a class="pull-right">{{$data->percentage}} %</a>
                                </li>
                            </ul>

                            <a href="{{url('admin/doctorPrograms/'.$data->id)}}" class="btn btn-success btn-block"><b>البرامج</b></a>
                            <a href="{{url('admin/doctorOrders/'.$data->id)}}" class="btn btn-info btn-block"><b>الطلبات</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">معلومات عن الطبيب</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i> نبذة عني</strong>

                            <p class="text-muted">
                            {{$data->description}}
                            </p>

                            <hr>

                            <strong><i class="fa fa-map-marker margin-r-5"></i> الموقع</strong>

                            <p class="text-muted">{{\App\Country::find($data->country_id)->name_ar}}, {{\App\City::find($data->city_id)->name_ar}}</p>

                            <hr>
                            <strong><i class="icon-envelope"></i> البريد الالكتروني</strong>

                            <p class="text-muted">{{$data->email}}</p>

                            <hr>
                            <strong><i class="fa fa-phone"></i> رقم الهاتف</strong>

                            <p class="text-muted">{{$data->phone}}</p>

                            <hr>


                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
