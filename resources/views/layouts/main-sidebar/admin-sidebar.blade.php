<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">
            {{ trans('main_trans.Programname') }}
        </li>

        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{ trans('main_trans.Grades') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('Grades.index') }}">{{ trans('main_trans.Grades_list') }}</a></li>

            </ul>
        </li>
        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                <div class="pull-left"><i class="fa fa-building"></i><span
                        class="right-nav-text">{{ trans('main_trans.classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('Classrooms.index') }}">{{ trans('main_trans.List_classes') }}</a>
                </li>
            </ul>
        </li>


        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.sections') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a
                        href="{{ route('Sections.index') }}">{{ trans('main_trans.List_sections') }}</a>
                </li>
            </ul>
        </li>


        <!-- students-->
        {{-- <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                <div class="pull-left"><i class="fas fa-user-graduate"></i></i></i><span
                        class="right-nav-text">{{ trans('main_trans.students') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>

            <ul id="students-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a
                        href="{{ route('Students.index') }}">{{ trans('main_trans.list_students') }}</a>
                </li>

                <li> <a href="{{ route('Students.create') }}">{{ trans('main_trans.add_student') }}
                    </a> </li>

                <li> <a href="{{ route('Promotion.index') }}">{{ trans('Students_trans.Promotion_students') }}
                    </a> </li>
                <li> <a href="{{ route('Promotion.create') }}">{{ trans('Students_trans.Management_Promotion_students') }}
                    </a> </li>
            </ul>
        </li> --}}

        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu"><i
                    class="fas fa-user-graduate"></i>{{ trans('main_trans.students') }}<div
                    class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse">
                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Student_information">{{ trans('main_trans.Student_information') }}
                        <div class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Student_information" class="collapse">
                        <li> <a href="{{ route('Students.create') }}">{{ trans('main_trans.add_student') }}
                            </a></li>
                        <a href="{{ url('Students') }}">{{ trans('main_trans.list_students') }}</a>
                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Students_upgrade">{{ trans('main_trans.Students_Promotions') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Students_upgrade" class="collapse">
                        <li> <a href="{{ route('Promotion.index') }}">{{ trans('Students_trans.Promotion_students') }}
                            </a> </li>
                        <li> <a href="{{ route('Promotion.create') }}">{{ trans('Students_trans.Management_Promotion_students') }}
                            </a> </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse"
                        data-target="#Graduate students">{{ trans('main_trans.Graduate_students') }}<div
                            class="pull-right"><i class="ti-plus"></i></div>
                        <div class="clearfix"></div>
                    </a>
                    <ul id="Graduate students" class="collapse">

                        <li> <a
                                href="{{ route('Graduated.index') }}">{{ trans('main_trans.list_Graduate') }}</a>
                        </li>
                        <li> <a
                                href="{{ route('Graduated.create') }}">{{ trans('main_trans.add_Graduate') }}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>

        <!-- Teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.Teachers') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a
                        href="{{ route('Teachers.index') }}">{{ trans('main_trans.List_Teachers') }}</a>
                </li>
            </ul>
        </li>


        <!-- Parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-user-tie"></i><span
                        class="right-nav-text">{{ trans('main_trans.Parents') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ url('add_parent') }}">{{ trans('main_trans.List_Parents') }}</a>
                </li>

        </li>
    </ul>
    </li>

    <!-- Accounts-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.Accounts') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ url('Fee') }}">{{ trans('main_trans.study fees') }} </a> </li>
            <li> <a href="{{ url('Fees_Invoices') }}">{{ trans('main_trans.Fees_Invoices') }}</a>
            <li> <a
                    href="{{ url('receipt_students') }}">{{ trans('main_trans.receipt_students') }}</a>
            <li> <a href="{{ url('ProcessingFee') }}">{{ trans('main_trans.ProcessingFee') }}</a>
            </li>

            <li> <a href="{{ url('Payment_students') }}">{{ trans('Students_trans.Receipt') }}</a>
            </li>Receipt
        </ul>
    </li>

    <!-- Attendance-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
            <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.Attendance') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ url('Attendance') }}">{{ trans('main_trans.list_students') }}</a> </li>

        </ul>
    </li>

    <!-- Subjects-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects-menu">
            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                    class="right-nav-text">{{ trans('main_trans.Subjects') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Subjects-menu" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ url('subjects') }}">{{ trans('main_trans.list_Subjects') }} </a>
            </li>

        </ul>
    </li>


    <!-- Exams-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
            <div class="pull-left"><i class="fas fa-book-open"></i><span
                    class="right-nav-text">{{ trans('main_trans.Exams') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ url('Quizzes') }}">{{ trans('main_trans.list_Exams') }} </a> </li>
            <li> <a href="{{ url('questions') }}">{{ trans('main_trans.list_Question') }} </a> </li>

        </ul>
    </li>


    <!-- library-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
            <div class="pull-left"><i class="fas fa-book"></i><span
                    class="right-nav-text">{{ trans('main_trans.library') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ url('library') }}">{{ trans('main_trans.list_library') }}</a> </li>
            <li> <a href="themify-icons.html">Themify icons</a> </li>
            <li> <a href="weather-icon.html">Weather icons</a> </li>
        </ul>
    </li>


    <!-- Onlinec lasses-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
            <div class="pull-left"><i class="fas fa-video"></i><span
                    class="right-nav-text">{{ trans('main_trans.Onlineclasses') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="{{ url('online_classes') }}">الاتصال مباشر مع زوم</a> </li>
            <li> <a href="themify-icons.html">الاتصال الغير مباشر مع زوم</a> </li>
        </ul>
    </li>


    <!-- Settings-->
    <li>
        <a href="{{ route('settings.index') }}"><i class="fas fa-cogs"></i><span
                class="right-nav-text">{{ trans('main_trans.Settings') }} </span></a>
    </li>


    <!-- Users-->
    <li>
        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
            <div class="pull-left"><i class="fas fa-users"></i><span
                    class="right-nav-text">{{ trans('main_trans.Users') }}</span></div>
            <div class="pull-right"><i class="ti-plus"></i></div>
            <div class="clearfix"></div>
        </a>
        <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
            <li> <a href="themify-icons.html">Themify icons</a> </li>
            <li> <a href="weather-icon.html">Weather icons</a> </li>
        </ul>
    </li>

    </ul>
</div>
