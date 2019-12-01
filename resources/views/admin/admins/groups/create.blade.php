@extends('admin.layouts.master')

@section('title')
    مجموعات المشرفين
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/datatables.bootstrap-rtl.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin/css/sweetalert.css') }}">
{{--    <link href="{{ URL::asset('admin/css/font-awesome.min.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ URL::asset('admin/css/simple-line-icons.min.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ URL::asset('admin/css/bootstrap-rtl.min.css"') }}" rel="stylesheet">--}}
    <link href="{{ URL::asset('admin/css/bootstrap-switch-rtl.min.css') }}" rel="stylesheet">

    <link href="{{ URL::asset('admin/css/components-rounded-rtl.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
{{--    <link href="{{ URL::asset('admin/css/plugins-rtl.min.') }}" rel="stylesheet" type="text/css" />--}}
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ URL::asset('admin/css/layout-rtl.min.css') }}" rel="stylesheet" type="text/css" />
{{--    <link href="{{ URL::asset('admin/css/themes/darkblue-rtl.min.css') }}" rel="stylesheet" type="text/css" id="style_color" />--}}
    <link href="{{ URL::asset('admin/css/custom-rtl.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('page_header')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <a href="/admin/home">لوحة التحكم</a>
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

    <h1 class="page-title"> إضافة مجموعة مشرفين
    </h1>
@endsection

@section('content')

    @if(session()->has('msg'))

        <p class="alert alert-success" style="width: 100%">

            {{ session()->get('msg') }}

        </p>

    @endif


    <form class="form-horizontal" method="post" action="{{ url('/admin/roles') }}">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-lg-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption font-red-sunglo">
                            <i class="icon-settings font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase"> مجموعات المشرفين </span>

                        </div>
                        <br><br><br>
                        <span class="caption-subject bold uppercase"> مجموعة جديدة </span>
                    </div>
                    <div class="portlet-body form">
                        <div class="btn-group"></div>

                        <div class="form-group">
                            <label for="role_name" class="col-lg-3 control-label">اسم المجموعة</label>
                            <div class="col-lg-6">
                                <input id="role_name" name="role_name" type="text" class="form-control" placeholder="اسم المجموعة">
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <?php
                        $admins = [];$roles = [];$cities = [];$articles=[];$orders=[];$countries=[];
                        $contacts=[];$doctor_requests=[];$sports=[];$pages=[];$services=[];$settings=[];$sliders=[];
                        $social_settings=[];$users=[];$important_links=[];$qualifications=[];$lecturer_courses=[];$lectures=[];$lectures_media=[];$certifcate_orders=[];
                        $programs=[]; $exams=[]; $question_answers=[]; $diplomas=[];  $diploma__lectures=[]; 
                        $diploma__lecture__media=[]; $diploma_exams=[];$notifications=[];
                        ?>
                        @foreach($data as $value)
                            @if($value->table_name === 'admins')
                                <?php array_push($admins, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'users')
                                <?php array_push($users, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'lecturer_courses')
                                <?php array_push($lecturer_courses, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif  
                            @if($value->table_name === 'lectures')
                                <?php array_push($lectures, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif  
                            @if($value->table_name === 'exams')
                                <?php array_push($exams, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif    
                            @if($value->table_name === 'question_answers')
                                <?php array_push($question_answers, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif  
                            @if($value->table_name === 'lectures_media')
                                <?php array_push($lectures_media, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif    
                            @if($value->table_name === 'diplomas')
                                <?php array_push($diplomas, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif  
                            @if($value->table_name === 'diploma__lectures')
                                <?php array_push($diploma__lectures, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif  
                            @if($value->table_name === 'diploma__lecture__media')
                                <?php array_push($diploma__lecture__media, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif   
                            @if($value->table_name === 'diploma_exams')
                                <?php array_push($diploma_exams, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'programs')
                                <?php array_push($programs, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'certifcate_orders')
                                <?php array_push($certifcate_orders, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif 
                            @if($value->table_name === 'cities')
                                <?php array_push($cities, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'articles')
                                <?php array_push($articles, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'countries')
                                <?php array_push($countries, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'orders')
                                <?php array_push($orders, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'contacts')
                                <?php array_push($contacts, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'doctor_requests')
                                <?php array_push($doctor_requests, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'sports')
                                <?php array_push($sports, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'pages')
                                <?php array_push($pages, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'services')
                                <?php array_push($services, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'roles')
                                <?php array_push($roles, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'settings')
                                <?php array_push($settings, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'social_settings')
                                <?php array_push($social_settings, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'sliders')
                                <?php array_push($sliders, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'important_links')
                                <?php array_push($important_links, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'qualifications')
                                <?php array_push($qualifications, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                            @if($value->table_name === 'notifications')
                                <?php array_push($notifications, ['permission_name' => $value->permission_name, 'id' => $value->id]) ?>
                            @endif
                        @endforeach
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.admins')</label>
                            @foreach($admins as $item)
                            <div class="md-checkbox col-md-3">
                                <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                <label for="{{$item['id']}}">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                            </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.users')</label>
                            @foreach($users as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>


                            <hr class="col-md-11">
                            <div class="form-group form-md-checkboxes  col-md-12">
                                <label class="col-md-12">@lang('permissions.programs')</label>
                                @foreach($programs as $role)
                                    <div class="md-checkbox col-md-3">
                                        <?php $true = 0 ;?>
                                        @foreach($data as $value)
                                            @if($value->permission_id == $role['id'])
                                                <?php $true++;?>
                                            @endif
                                        @endforeach
                                        <input type="checkbox" id="{{$role['id']}}" name="permission[]" class="md-check" value="{{$role['id']}}" @if(!$true)  @else checked  @endif>
                                        <label for="{{$role['id']}}">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span> @lang('permissions.' . $role['permission_name'])</label>
                                    </div>
                                @endforeach
                            </div> 


                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.articles')</label>
                            @foreach($articles as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.settings')</label>
                            @foreach($settings as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.orders')</label>
                            @foreach($orders as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.doctor_requests')</label>
                            @foreach($doctor_requests as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.contacts')</label>
                            @foreach($contacts as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.sliders')</label>
                            @foreach($sliders as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.countries')</label>
                            @foreach($countries as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.cities')</label>
                            @foreach($cities as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.sports')</label>
                            @foreach($sports as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.roles')</label>
                            @foreach($roles as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="form-group form-md-checkboxes">
                            <label class="col-md-12">@lang('permissions.notifications')</label>
                            @foreach($notifications as $item)
                                <div class="md-checkbox col-md-3">
                                    <input type="checkbox" id="{{$item['id']}}" name="permission[]" class="md-check" value="{{$item['id']}}">
                                    <label for="{{$item['id']}}">
                                        <span></span>
                                        <span class="check"></span>
                                        <span class="box"></span> @lang('permissions.' . $item['permission_name'])</label>
                                </div>
                            @endforeach
                        </div>

                        <div class="form-actions">
                            <div class="row">
                                <div class="col-lg-2 col-lg-offset-10">
                                    {{--<button type="submit" class="btn green btn-block">حفظ</button>--}}
                                    <input class="btn green btn-block" type="submit" value="حفظ" onclick="this.disabled=true;this.value='تم الارسال, انتظر...';this.form.submit();" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

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
    <script src="{{ URL::asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script src="{{ URL::asset('admin/js/layout.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/demo.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/quick-sidebar.min.js') }}"></script>
    <script src="{{ URL::asset('admin/js/quick-nav.min.js') }}"></script>
    {{--<script>--}}
        {{--$(document).ready(function()--}}
        {{--{--}}
            {{--$('#clickmewow').click(function()--}}
            {{--{--}}
                {{--$('#radio1003').attr('checked', 'checked');--}}
            {{--});--}}
        {{--})--}}
    {{--</script>--}}
@endsection