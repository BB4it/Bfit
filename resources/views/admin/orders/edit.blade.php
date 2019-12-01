@extends('admin.layouts.master')

@section('title')
    عرض بيانات الطلب
@endsection
@section('styles')
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
                <a href="/admin/orders">الطلبات</a>
                <i class="fa fa-circle"></i>
            </li>
            <li>
                <span>عرض  الطلبات</span>
            </li>
        </ul>
    </div>

    <h1 class="page-name">عرض  الطلبات
        {{--<small>تعديل جميع  ملخصات الكتب</small>--}}
    </h1>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-8">
            <!-- BEGIN TAB PORTLET-->
            <form method="post" action="/admin/update/program/{{$order->id}}" enctype="multipart/form-data"  >
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
                                                    <label class="col-md-3 control-label">رقم الطلب</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" disabled value="{{$order->id}}">
                                                    </div>

                                                </div>

                                                <?php $program = \App\Program::where('id',$order->program_id)->first();
                                                        $doctor = \App\User::where('id',$program->user_id)->first();
                                                ?>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">اسم البرنامج</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" disabled value="{{$program->title}}">
                                                    </div>
                                                    <label class="col-md-3 control-label">اسم الطبيب المسئول</label>
                                                    <div class="col-md-3">
                                                        <input type="text" class="form-control" disabled value="{{$doctor->name}}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">حالة الطلب</label>
                                                    <div class="col-md-9">
                                                        @if($order->status == 1)
                                                        <input type="text" class="form-control" disabled value="طلب نشط">
                                                        @else
                                                        <input type="text" class="form-control" disabled value="طلب مُنتهى">
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"> السعر بالريال</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" name="price" disabled value="{{$order->cost}}" >
                                                    </div>
                                                </div>
                                                 <hr>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"> مدة الاشتراك</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="period" disabled value="{{$order->period}}" >
                                                    </div>
                                                </div>
                                                 <hr>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"> بدايه الاشتراك</label>
                                                    <div class="col-md-9">
                                                        <input type="date" class="form-control" name="start_date" disabled value="{{$order->start_date}}" >
                                                    </div>
                                                </div>
                                                 <hr>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"> نهاية الاشتراك</label>
                                                    <div class="col-md-9">
                                                        <input type="date" class="form-control" name="end_date" disabled value="{{$order->end_date}}" >
                                                    </div>
                                                </div>
                                                 <hr>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">الاسم </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->name}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">العمر </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->age}}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">النوع</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="gender" disabled style="height:36px">
                                                            <option value="1" {{$order->gender == 1? 'selected' : '' }}>ذكر</option>
                                                            <option value="2" {{$order->gender == 2? 'selected' : '' }}>أنثى</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">الوزن </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->weight}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">الطول </label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->tall}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">هل تُعانى من أى أمراض مزمنة أو مشاكل صحية؟ </label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="health_diseases" disabled style="height:36px">
                                                            <option value="1" {{$order->health_diseases == 0? 'selected' : '' }}>نعم</option>
                                                            <option value="2" {{$order->health_diseases == 1? 'selected' : '' }}>لا</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">الهدف من الإشتراك </label>
                                                    <div class="col-md-9">
                                                        <?php $goals = \App\Sport::where('type','goals')->get(); ?>
                                                        <select class="form-control" name="subscription_goals_id" disabled style="height:36px">
                                                            @foreach($goals as $goal)
                                                            <option value="{{$goal->id}}" {{$order->subscription_goals_id == $goal->id? 'selected' : '' }}>{{$goal->text}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">مستوى النشاط الرياضى</label>
                                                    <div class="col-md-9">
                                                        <?php $levels = \App\Sport::where('type','levels')->get();  ?>
                                                        <select class="form-control" name="subscription_goals_id" disabled style="height:36px">
                                                            @foreach($levels as $level)
                                                            <option value="{{$level->id}}" {{$order->subscription_goals_id == $level->id? 'selected' : '' }}>{{$level->text}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">نوع النشاط الرياضى</label>
                                                    <div class="col-md-9">
                                                        <?php $types = \App\Sport::where('type','types')->get();  ?>
                                                        <select class="form-control" name="sports_types_id" disabled style="height:36px">
                                                            @foreach($types as $type)
                                                            <option value="{{$type->id}}" {{$order->sports_types_id == $type->id? 'selected' : '' }}>{{$type->text}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">هل يوجد حساسية تجاه الطعام؟</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control" name="food_allergy" disabled style="height:36px">
                                                            <option value="1" {{$order->food_allergy == 0? 'selected' : '' }}>لا</option>
                                                            <option value="2" {{$order->food_allergy == 1? 'selected' : '' }}>نعم</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">هل هناك أدوية تأخذها باستمرار؟</label>
                                                    <div class="col-md-3">
                                                        <select class="form-control" name="medicine_status" disabled style="height:36px">
                                                            <option value="1" {{$order->medicine_status == 0? 'selected' : '' }}>لا</option>
                                                            <option value="2" {{$order->medicine_status == 1? 'selected' : '' }}>نعم</option>
                                                        </select>
                                                    </div>
                                                    @if($order->medicine_status == 1)
                                                        <label class="col-md-3 control-label">اسم الدواء </label>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" disabled value="{{$order->medicine_name}}" >
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">أكثر المناطق فى جسمك تحتوى على دهون</label>
                                                    <div class="col-md-9">
                                                        <?php $fats = \App\Sport::where('type','fats')->get();  ?>
                                                        <select class="form-control" name="fats_area_id" disabled style="height:36px">
                                                            @foreach($fats as $fat)
                                                            <option value="{{$fat->id}}" {{$order->fats_area_id == $fat->id? 'selected' : '' }}>{{$fat->text}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">عدد الوجبات</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->meals_number}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="col-md-3 control-label"> قياس نسبة الدهون فى الجسم</label>
                                                    <div class="col-md-9">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                                @if($order->image !==null)
                                                                    {{--<a href='{{ asset("uploads/orders/$order->image") }}' >--}}
                                                                    <img  src='{{ asset("uploads/orders/$order->image") }}'>
                                                                    </a>

                                                                @endif
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <hr>

                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">مقاس الذراع الأيمن</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->right_arm}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">مقاس الذراع الأيسر</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->left_arm}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">مقاس محيط الصدر</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->chest}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">مقاس محيط الأرداف</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->buttocks}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">مقاس محيط البطن</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->belly}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">مقاس محيط الفخذ الأيمن</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->right_thigh}}" >
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">مقاس محيط الفخذ الأيسر</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" disabled value="{{$order->left_thigh}}" >
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

            </form>
            <!-- END TAB PORTLET-->





        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script src=" {{ URL::asset('admin/js/jquery.repeater.js') }}" type="text/javascript"></script>

    <script src=" {{ URL::asset('admin/js/form-repeater.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('admin/js/sweetalert.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/ui-sweetalert.min.js') }}"></script>
    <script>

        CKEDITOR.replace('description2');
        $(document).ready(function() {
            var CSRF_TOKEN = $('meta[name="X-CSRF-TOKEN"]').attr('content');

            $('body').on('click', '.delete_pdf_file', function() {
                // var id = $(this).attr('data');
                var id_pdf = $(this).attr('data');
                var id_bookReview = $(this).attr('data_sub');
                var swal_text = 'حذف ' + $(this).attr('data_name') + '؟';
                var swal_name = 'هل أنت متأكد من الحذف ؟';

                swal({
                    name: swal_name,
                    text: swal_text,
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: "تأكيد",
                    cancelButtonText: "إغلاق",
                    closeOnConfirm: false
                }, function() {

                    window.location.href = "{{ url('/') }}" + "/admin/delete/"+id_pdf +'/'+id_bookReview+"/BookReview/pdf";


                });

            });

        });

    </script>


@endsection
