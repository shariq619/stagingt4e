<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('crm.dashboard.index') }}" class="logo">
                <img src="{{ asset('frontend/img/logo.webp') }}" alt="navbar brand" class="navbar-brand" height="100" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Request::is('crm/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('crm.dashboard.index') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section"></h4>
                </li>

                <li class="nav-item {{ Request::is('crm/customers') ? 'active' : '' }}">
                    <a href="{{ route('crm.customers.index') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-users"></i>
                        <p>Customers</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('crm/courses') ? 'active' : '' }}">
                    <a href="{{ route('crm.training-courses.index') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-book-open"></i>
                        <p>Training Courses</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('crm/learner-delegates') ? 'active' : '' }}">
                    <a href="{{ route('crm.learner.delegates.index') }}" class="collapsed" aria-expanded="false">
                        <i class="fas fa-user-graduate"></i>
                        <p>Learner Delegates</p>
                    </a>
                </li>
                <li class="nav-item {{ Request::is('crm/email_mappings*') || Request::is('crm/email_templates*') || Request::is('crm/email_triggers*') ? 'submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-envelope"></i>
                        <p>Email</p><span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::is('crm/email_mappings*') || Request::is('crm/email_templates*') || Request::is('crm/email_triggers*') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ Request::is('crm/email_mappings*') ? 'active' : '' }}">
                                <a href="{{ route('crm.email_mappings.index') }}">
                                    <span class="sub-item">Email Mappings</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('crm/email_templates*') ? 'active' : '' }}">
                                <a href="{{ route('crm.email_templates.index') }}">
                                    <span class="sub-item">Email Templates</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request::is('crm/email_triggers*') ? 'active' : '' }}">
                                <a href="{{ route('crm.email_triggers.index') }}">
                                    <span class="sub-item">Email Triggers</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>




                {{--                    <li class="nav-item"> --}}
                {{--                        <a data-bs-toggle="collapse" href="#base"> --}}
                {{--                            <i class="fas fa-layer-group"></i> --}}
                {{--                            <p>Base</p> --}}
                {{--                            <span class="caret"></span> --}}
                {{--                        </a> --}}
                {{--                        <div class="collapse" id="base"> --}}
                {{--                            <ul class="nav nav-collapse"> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/avatars.html"> --}}
                {{--                                        <span class="sub-item">Avatars</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/buttons.html"> --}}
                {{--                                        <span class="sub-item">Buttons</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/gridsystem.html"> --}}
                {{--                                        <span class="sub-item">Grid System</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/panels.html"> --}}
                {{--                                        <span class="sub-item">Panels</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/notifications.html"> --}}
                {{--                                        <span class="sub-item">Notifications</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/sweetalert.html"> --}}
                {{--                                        <span class="sub-item">Sweet Alert</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/font-awesome-icons.html"> --}}
                {{--                                        <span class="sub-item">Font Awesome Icons</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/simple-line-icons.html"> --}}
                {{--                                        <span class="sub-item">Simple Line Icons</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="components/typography.html"> --}}
                {{--                                        <span class="sub-item">Typography</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                            </ul> --}}
                {{--                        </div> --}}
                {{--                    </li> --}}

                {{--                    <li class="nav-item"> --}}
                {{--                        <a data-bs-toggle="collapse" href="#forms"> --}}
                {{--                            <i class="fas fa-pen-square"></i> --}}
                {{--                            <p>Forms</p> --}}
                {{--                            <span class="caret"></span> --}}
                {{--                        </a> --}}
                {{--                        <div class="collapse" id="forms"> --}}
                {{--                            <ul class="nav nav-collapse"> --}}
                {{--                                <li> --}}
                {{--                                    <a href="forms/forms.html"> --}}
                {{--                                        <span class="sub-item">Basic Form</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                            </ul> --}}
                {{--                        </div> --}}
                {{--                    </li> --}}
                {{--                    <li class="nav-item"> --}}
                {{--                        <a data-bs-toggle="collapse" href="#tables"> --}}
                {{--                            <i class="fas fa-table"></i> --}}
                {{--                            <p>Tables</p> --}}
                {{--                            <span class="caret"></span> --}}
                {{--                        </a> --}}
                {{--                        <div class="collapse" id="tables"> --}}
                {{--                            <ul class="nav nav-collapse"> --}}
                {{--                                <li> --}}
                {{--                                    <a href="tables/tables.html"> --}}
                {{--                                        <span class="sub-item">Basic Table</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="tables/datatables.html"> --}}
                {{--                                        <span class="sub-item">Datatables</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                            </ul> --}}
                {{--                        </div> --}}
                {{--                    </li> --}}
                {{--                    <li class="nav-item"> --}}
                {{--                        <a data-bs-toggle="collapse" href="#maps"> --}}
                {{--                            <i class="fas fa-map-marker-alt"></i> --}}
                {{--                            <p>Maps</p> --}}
                {{--                            <span class="caret"></span> --}}
                {{--                        </a> --}}
                {{--                        <div class="collapse" id="maps"> --}}
                {{--                            <ul class="nav nav-collapse"> --}}
                {{--                                <li> --}}
                {{--                                    <a href="maps/googlemaps.html"> --}}
                {{--                                        <span class="sub-item">Google Maps</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="maps/jsvectormap.html"> --}}
                {{--                                        <span class="sub-item">Jsvectormap</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                            </ul> --}}
                {{--                        </div> --}}
                {{--                    </li> --}}
                {{--                    <li class="nav-item"> --}}
                {{--                        <a data-bs-toggle="collapse" href="#charts"> --}}
                {{--                            <i class="far fa-chart-bar"></i> --}}
                {{--                            <p>Charts</p> --}}
                {{--                            <span class="caret"></span> --}}
                {{--                        </a> --}}
                {{--                        <div class="collapse" id="charts"> --}}
                {{--                            <ul class="nav nav-collapse"> --}}
                {{--                                <li> --}}
                {{--                                    <a href="charts/charts.html"> --}}
                {{--                                        <span class="sub-item">Chart Js</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                                <li> --}}
                {{--                                    <a href="charts/sparkline.html"> --}}
                {{--                                        <span class="sub-item">Sparkline</span> --}}
                {{--                                    </a> --}}
                {{--                                </li> --}}
                {{--                            </ul> --}}
                {{--                        </div> --}}
                {{--                    </li> --}}

            </ul>
        </div>
    </div>
</div>
