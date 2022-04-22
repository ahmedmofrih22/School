<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">



            @if (auth('web')->check())
                @include('layouts.main-sidebar.admin-sidebar');
            @endif
            @if (auth('student')->check())
                @include('layouts.main-sidebar.student-sidebar');
            @endif
            @if (auth('teacher')->check())
                @include('layouts.main-sidebar.teacher-sidebar');
            @endif
            @if (auth('parent')->check())
                @include('layouts.main-sidebar.parent-sidebar');
            @endif
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
