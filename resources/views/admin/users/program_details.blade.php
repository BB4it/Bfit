@extends('admin.layouts.master')

@section('title')
    تفاصيل البرنامج
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
              تفاصيل البرنامج
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-9">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle img-center" src="{{$program->image ? asset('uploads/programs/'.$program->image) : asset('admin/img/user.png')}}" alt="User profile picture">

                            <h3 class="profile-username text-center">{{$program->title}}</h3>


                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>المدة</b> <a class="pull-right">{{$program->period}} شهر </a>
                                </li>
                                <li class="list-group-item">
                                    <b>التفعيل</b> <a class="pull-right">{{$program->active == 1 ? 'مفعل'  : 'غير مفعل'}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b> السعر</b> <a class="pull-right">{{$program->price}}  ريال </a>
                                </li>

                            </ul>
                            <a href="{{url('admin/doctorDetails/'.$program->user_id)}}" class="btn btn-info btn-block"><b> الطبيب : {{\App\User::find($program->user_id)->name}} </b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">معلومات عن البرنامج</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-book margin-r-5"></i>معلومات</strong>

                            <p class="text-muted">
                            {!! $program->description !!}
                            </p>

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
