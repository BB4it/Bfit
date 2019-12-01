<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <li class="nav-item start active open" >
                <a href="/admin/home" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">الرئيسية</span>
                    <span class="selected"></span>

                </a>
            </li>
            <li class="heading">
                <h3 class="uppercase">القائمة الجانبية</h3>
            </li>
            <li class="nav-item {{ strpos(URL::current(), 'roles') !== false ? 'active' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="fa fa-group"></i>
                    <span class="title">مجموعات المشرفين</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ url('/admin/roles') }}" class="nav-link ">
                            <span class="title">عرض مجموعات المشرفين</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/roles/create') }}" class="nav-link ">
                            <span class="title">اضافة مجموعة مشرفين</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ strpos(URL::current(), 'admins') !== false ? 'active' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">المشرفين</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ url('/admin/admins') }}" class="nav-link ">
                            <span class="title">عرض المشرفين</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/admins/create') }}" class="nav-link ">
                            <span class="title">اضافة مشرف</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ strpos(URL::current(), 'admin/user') !== false ? 'active' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">المستخدمين</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ url('/admin/user/1') }}" class="nav-link ">
                            <span class="title">الأطباء</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/user/2') }}" class="nav-link ">
                            <span class="title">المستخدمين</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ strpos(URL::current(), 'admin/sports') !== false ? 'active' : '' }}">
                <a href="/admin/sports" class="nav-link ">
                    <i class="icon-envelope"></i>
                    <span class="title"> الأنشطة الرياضية</span>

                </a>
            </li>

            <li class="nav-item {{ strpos(URL::current(), 'admin/orders') !== false ? 'active' : '' }}">
                <a href="/admin/orders" class="nav-link ">
                    <i class="icon-envelope"></i>
                    <span class="title">الطلبات</span>

                </a>
            </li>

            <li class="nav-item {{ strpos(URL::current(), 'admin/country') !== false ? 'active' : '' }}">
                <a href="/admin/country" class="nav-link ">
                    <i class="icon-flag"></i>
                    <span class="title">الدول</span>

                </a>
            </li>
            <li class="nav-item {{ strpos(URL::current(), 'admin/city') !== false ? 'active' : '' }}">
                <a href="/admin/city" class="nav-link ">
                    <i class="icon-flag"></i>
                    <span class="title">المدن</span>

                </a>
            </li>
            <li class="nav-item {{ strpos(URL::current(), 'admin/slider') !== false ? 'active' : '' }}">
                <a href="/admin/slider" class="nav-link ">
                    <i class="fa fa-image"></i>
                    <span class="title">اسلايدر</span>

                </a>
            </li>
            <li class="nav-item {{ strpos(URL::current(), 'admin/article') !== false ? 'active' : '' }}">
                <a href="/admin/article" class="nav-link ">
                    <i class="fa fa-book"></i>
                    <span class="title">المقالات </span>

                </a>
            </li>
            <li class="nav-item {{ strpos(URL::current(), 'admin/programs') !== false ? 'active' : '' }}">
                <a href="/admin/programs" class="nav-link ">
                    <i class="fa fa-book"></i>
                    <span class="title">البرامج</span>

                </a>
            </li>

            <?php  $requests = \App\DoctorRequest::count();?>
            <li class="nav-item {{ strpos(URL::current(), 'admin/doctorRequest') !== false ? 'active' : '' }}">
                <a href="{{URL::to('/admin/doctorRequest')}}" class="nav-link ">
                    <i class="fa fa-list-alt"></i>
                    <span class="title"> طلبات انضمام الأطباء</span>
                    <small class="label pull-right bg-red" >{{$requests}}</small>
                </a>
            </li>

            <li class="nav-item {{ strpos(URL::current(), 'admin/setting') !== false ? 'active' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">الاعدادات العامة</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="/admin/setting" class="nav-link ">
                            <span class="title">اعدادات الموقع</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/setting/aboutApp" class="nav-link ">
                            <span class="title">عن التطبيق</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/setting/conditions_terms" class="nav-link ">
                            <span class="title">الشروط والأحكام</span>
                        </a>
                    </li><li class="nav-item">
                        <a href="/admin/setting/questionAnswer" class="nav-link ">
                            <span class="title">الأسئلة الشائعة</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item {{ strpos(URL::current(), 'admin/contactUs') !== false ? 'active' : '' }}">
                <a href="/admin/contactUs" class="nav-link ">
                    <i class="icon-envelope"></i>
                    <span class="title"> تواصل معنا</span>

                </a>
            </li>
            <li class="nav-item {{ strpos(URL::current(), 'admin/notifications') !== false ? 'active' : '' }}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-bell"></i>
                    <span class="title">الاشعارات</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item">
                        <a href="{{ route('notifications.create', 'user') }}" class="nav-link ">
                            <span class="title">ارسال اشعار للمستخدمين</span>
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>