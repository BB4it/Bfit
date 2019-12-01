@extends('admin.layouts.master')

@section('title')
    بيانات الصفحة
@endsection



@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <a href="/admin/setting/mainPages">الصفحات الرئيسية</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض الصفحات الرئيسية</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض الصفحات الرئيسية
        <small> بيانات الصفحة</small>
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/mainpage/{{$page->id}}" >
                <input type = 'hidden' name = '_token' value = '{{Session::token()}}'>
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-anchor font-green-sharp"></i>
                            <span class="caption-subject font-green-sharp bold uppercase">تعديل بيانات الصفحة</span>
                        </div>

                    </div>


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
                                                                <label class="col-md-3 control-label">الاسم</label>
                                                                <div class="col-md-9">
                                                                    <input type="text" name="title" class="form-control" placeholder="الاسم" value="{{$page->title}}">
                                                                    @if ($errors->has('title'))
                                                                        <span class="help-block">
                                                                           <strong style="color: red;">{{ $errors->first('title') }}</strong>
                                                                        </span>
                                                                    @endif
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

