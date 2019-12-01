<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="">
                <img src="{{ URL::asset('admin/img/small_logo.png') }}" alt="logo" class="logo-default" style="width:50%" /> </a>
            <div class="menu-toggler sidebar-toggler">
                <span></span>
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <!-- BEGIN NOTIFICATION DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                 
                 
                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar" onclick="delete_number();">
                    <!-- <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span class="badge badge-default" id="mySpan_notification1"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>
                                <span class="bold" id="mySpan_notification"></span> إشعارات جديدة
                            </h3>
                            <a href="">مشاهدة الكل</a>
                        </li>
                        <li>
                            <ul id="number_notification" class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">

                            </ul>
                        </li>
                    </ul> -->
                </li>

                <!-- END TODO DROPDOWN -->
                <!-- BEGIN USER LOGIN DROPDOWN -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <!-- <img alt="" class="img-circle" src="" /> -->
                        <span class="username username-hide-on-mobile"> <?php if(Auth::guard('admin')->check()) { echo Auth::guard('admin')->user()->name; } ?> </span>

                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="/admin/profile">
                                <i class="icon-user"></i> صفحتي الشخصية </a>
                        </li>
                        <li>
                            <a href="/admin/profileChangePass">
                                <i class="icon-user"></i> تغيير كلمة المرور </a>
                        </li>
                        {{--<li>--}}
                        {{--<a href="app_calendar.html">--}}
                        {{--<i class="icon-calendar"></i> My Calendar </a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="app_inbox.html">--}}
                        {{--<i class="icon-envelope-open"></i> My Inbox--}}
                        {{--<span class="badge badge-danger"> 3 </span>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                        {{--<a href="app_todo.html">--}}
                        {{--<i class="icon-rocket"></i> My Tasks--}}
                        {{--<span class="badge badge-success"> 7 </span>--}}
                        {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="divider"> </li>--}}
                        {{--<li>--}}
                        {{--<a href="page_user_lock_1.html">--}}
                        {{--<i class="icon-lock"></i> Lock Screen </a>--}}
                        {{--</li>--}}
                        <li>
                            <a onclick="document.getElementById('logout_form').submit()">
                                <i class="icon-key"></i> تسجيل الخروج
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
            {{--<li class="dropdown dropdown-quick-sidebar-toggler">--}}
            {{--<a href="javascript:;" class="dropdown-toggle">--}}
            {{--<i class="icon-logout"></i>--}}
            {{--</a>--}}
            {{--</li>--}}
            <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>

        <form style="display: none;" id="logout_form" action="{{ route('admin.logout') }}" method="post">
            {!! csrf_field() !!}
        </form>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>