<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ setActive('admin') }}"><a href="{{route('admin.root') }}"> <i
                            class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a></li>


            <li class="treeview {{ setActive(['admin/user*', 'admin/group*']) }}"><a href="#"> <i
                            class="fa fa-user"></i> <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route("admin.user.index")  }}"><i class=""></i> User</a>
                    </li>
                    <li><a href="{{ url('/admin/group') }}"><i class=""></i>Group</a>
                    </li>
                </ul>
            </li>

            <li class="treeview {{setActive(['admin/topic*', 'admin/messagetemplate*']) }}"><a href="#"> <i
                            class="fa fa-folder-open-o"></i>
                    <span>Content Management</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li class="{{ setActive('admin/menu*') }}"><a href="{{ url('/admin/menu') }}"> <i
                                    class=""></i> <span>Menu</span> </a>
                    </li>
                    <li class="{{ setActive('admin/menu*') }}"><a href="{{ route("admin.topic.index")  }}"> <i
                                    class=""></i> <span>Topic</span> </a>
                    </li>
                    <li class="{{ setActive('admin/menu*') }}"><a href="{{ route("admin.messagetemplate.index")  }}"> <i
                                    class=""></i> <span>Message Templates</span> </a>
                    </li>

                </ul>
            </li>


            <li class="treeview  {{ setActive(['admin/setting*','admin/email-account*','admin/activity*']) }} ">
                <a
                        href="#"> <i class="fa fa fa-wrench"></i>
                    <span>Configuration</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li class="treeview {{setActive(['admin/setting/generalsetting*','admin/setting/usersetting*']) }}">


                        <a href="#"> <i class=""></i>
                            <span>Settings</span>
                            <i class="fa fa-angle-left pull-right"></i> </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route("admin.setting.generalsetting") }}"><i class=""></i> All
                                    General Setting</a>
                            </li>
                            <li><a href={{route("admin.setting.usersetting")}}><i class=""></i>
                                    User Setting</a>
                            </li>

                        </ul>

                    </li>
                    <li class="treeview {{setActive(['admin/activity/activitytype*','admin/activity/activitylog*']) }}">

                        <a href="#"> <i class=""></i>
                            <span>Activity log</span>
                            <i class="fa fa-angle-left pull-right"></i> </a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route("admin.activity.activitytype.index") }}"><i class=""></i>
                                    Activity Types</a>
                            </li>
                            <li><a href={{route("admin.activity.activitylog.index")}}><i class=""></i>
                                    Activity Log</a>
                            </li>
                        </ul>

                    </li>

                    <li><a href="{{ route("admin.email-account.index")  }}"><i class=""></i> Email Accounts</a>
                    </li>


                    <li><a href="{{ route("admin.security.permissions.index") }}"><i class=""></i> Access Control
                            List</a>
                    </li>

                </ul>
            </li>

            <li class="treeview {{ setActive(['admin/log*', 'admin/imformation*']) }}"><a href="#"> <i
                            class="fa fa-thumb-tack"></i> <span>System</span>
                    <i class="fa fa-angle-left pull-right"></i> </a>
                <ul class="treeview-menu">
                    <li class="{{ setActive('aadmin/log*') }}"><a href="{{ route('admin.system.log') }}"><i
                                    class=""></i> Log</a></li>


                    <li class="{{ setActive('admin/imformation*') }}"><a href="{{ url( '/admin/imformation') }}"><i
                                    class=""></i> System Imformation</a></li>

                </ul>
            </li>


        </ul>
    </section>
    <!-- /.sidebar -->
</aside>