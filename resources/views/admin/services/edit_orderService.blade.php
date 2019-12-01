@extends('admin.layouts.master')

@section('title')
    تعديل جميع طلبات الخدمات
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
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
                <a href="/admin/services/orderService">طلبات الخدمات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض طلبات الخدمات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-title">عرض طلبات الخدمات
        <small>تعديل جميع طلبات الخدمات</small>
    </h1>
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    @if (session('pdfs'))
        <div class="alert alert-danger">
            {{ session('pdfs') }}
        </div>
    @endif
    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/services/update/orderService/{{$order->id}}" enctype="multipart/form-data"  >
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
                                                    <label class="col-md-3 control-label">الاسم</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="name" class="form-control" placeholder="الاسم" value="{{$order->name}}">
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('name') }}</strong>
                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">رقم الهاتف</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="phone_number" class="form-control" placeholder="رقم الهاتف" value="{{$order->phone_number}}">
                                                        @if ($errors->has('phone_number'))
                                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">البريد الالكتروني</label>
                                                    <div class="col-md-9">
                                                        <input type="email" name="email" class="form-control" placeholder="البريد الالكتروني" value="{{$order->email}}">
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('email') }}</strong>
                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">العنوان</label>
                                                    <div class="col-md-9">
                                                        <input type="text" name="address" class="form-control" placeholder="العنوان" value="{{$order->address}}">
                                                        @if ($errors->has('address'))
                                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('address') }}</strong>
                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">التفاصيل</label>
                                                    <div class="col-md-9">
                                                        <textarea class="form-control"  rows="3" placeholder="التفاصيل" name="description" >{!! $order->description !!}</textarea>
                                                        @if ($errors->has('description'))
                                                            <span class="help-block">
                                               <strong style="color: red;">{{ $errors->first('description') }}</strong>
                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @if($order->file !== null)
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">رفع ملف </label>
                                                    <div class="col-md-9">
                                                    <a  href="{{ env('APP_URL').'/'.config('app.folder_name').'/storage/app/upload/'.$order->file }}" target="_blank">{{$order->file}}</a>
                                                        <a class="delete_pdf_file" data="{{ $order->id  }}" data_name="{{ $order->file  }}"  style="color: red;" > مسح</a>
                                                   </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">رفع ملف </label>
                                                    <div class="col-md-9">

                                                        <input type="file" name="upload_file" placeholder="ملف" class="form-control" />
                                                        @if ($errors->has('upload_file'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('upload_file') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-md-3 control-label">اختر الدولة</label>
                                                <div class="col-lg-9">
                                                    <div class=" input-group select2-bootstrap-append">
                                                        <select  name="country" class="form-control select2-allow-clear" id="choose_country">
                                                            <option value>اختر الدولة</option>
                                                            @foreach($countries as $country)
                                                                @if($country->parent_id == null)
                                                                    <?php $id=\App\Country::find($order->country_id)->parent_id; $country_id=\App\Country::find($id)->id; ?>
                                                                    <option value="{{$country->id}}" {{$country_id == $country->id ? 'selected': ''}}>{{$country->name}}</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                        @if ($errors->has('country'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('country') }}</strong>
                                                            </span>
                                                        @endif
                                                        <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-md-3 control-label">اختر المدينة</label>
                                                <div class="col-lg-9">
                                                    <div class=" input-group select2-bootstrap-append">
                                                        <select  name="city" class="form-control select2-allow-clear" id="choose_city">
                                                            @foreach($countries as $country)
                                                                @if($country->parent_id !== null)
                                                                    <option value="{{$country->id}}" {{$order->country_id == $country->id ? 'selected': ''}}>{{$country->name}}</option>
                                                                @endif
                                                            @endforeach

                                                        </select>
                                                        @if ($errors->has('city'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('city') }}</strong>
                                                            </span>
                                                        @endif
                                                        <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-md-3 control-label">اختر الخدمة</label>
                                                <div class="col-lg-9">
                                                    <div class=" input-group select2-bootstrap-append">
                                                        <select  name="service" class="form-control select2-allow-clear">
                                                            <option value>اختر الخدمة</option>
                                                            @foreach($services as $service)
                                                                <option value="{{$service->id}}" {{$order->service_id == $service->id ? 'selected': ''}}>{{$service->title}}</option>

                                                            @endforeach

                                                        </select>
                                                        @if ($errors->has('service'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('service') }}</strong>
                                                            </span>
                                                        @endif
                                                        <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-md-3 control-label">اختر المطلوب</label>
                                                <div class="col-lg-9">
                                                    <div class=" input-group select2-bootstrap-append">
                                                        <select  name="required_services" class="form-control select2-allow-clear">
                                                            <option value>اختر المطلوب</option>
                                                            @foreach($required_services as $service)
                                                                <option value="{{$service->id}}" {{$order->required_service_id == $service->id ? 'selected': ''}}>{{$service->text}}</option>

                                                            @endforeach

                                                        </select>
                                                        @if ($errors->has('required_services'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('required_services') }}</strong>
                                                            </span>
                                                        @endif
                                                        <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="gender" class="col-md-3 control-label">اختر نوع الخدمة</label>
                                                <div class="col-lg-9">
                                                    <div class=" input-group select2-bootstrap-append">
                                                        <select  name="service_type" class="form-control select2-allow-clear">

                                                            <option value>اختر النوع</option>
                                                            <option value="سكني" {{$order->service_type == "سكني" ? 'selected': ''}}>سكني</option>
                                                            <option value="تجاري" {{$order->service_type == "تجاري" ? 'selected': ''}}>تجاري</option>



                                                        </select>
                                                        @if ($errors->has('service_type'))
                                                            <span class="help-block">
                                                               <strong style="color: red;">{{ $errors->first('service_type') }}</strong>
                                                            </span>
                                                        @endif
                                                        <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" data-select2-open="single-append-text">
                                                            <span class="glyphicon glyphicon-search"></span>
                                                        </button>
                                                    </span>
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
    <script src="{{ URL::asset('admin/js/select2.full.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/components-select2.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script src="{{ URL::asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/ui-sweetalert.min.js') }}"></script>
    <script>

        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="X-CSRF-TOKEN"]').attr('content');

            $('body').on('click', '.delete_pdf_file', function() {
                // var id = $(this).attr('data');
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

                    window.location.href = "{{ url('/') }}" + "/admin/services/delete/"+id +"/orderService/pdf";


                });

            });

        });

    </script>
@endsection
