<header class="topbar">
    <div class="topbar-inner container-fluid">
        <a href="{{ route('crm.dashboard.index') }}" class="brand">
            <span class="brand-mark"></span>
            <img src="{{ asset('crm/assets/img/logo.png') }}" alt="Image">
        </a>

        <nav class="nav-strip">
            <div class="nav-scroll">
                <a href="{{ route('crm.dashboard.index') }}" class=" tb-link {{ Request::is('crm/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('crm.customers.index') }}" class="tb-link {{ Request::is('crm/customers') ? 'active' : '' }}">
                    <i class="fas fa-users"></i><span>Customers</span>
                </a>
                <a href="{{ route('crm.training-courses.index') }}" class="tb-link {{ Request::is('crm/training-courses') ? 'active' : '' }}">
                    <i class="fas fa-book-open"></i><span>Training Courses</span>
                </a>
                <a href="{{ route('crm.learner.delegates.index') }}" class="tb-link {{ Request::is('crm/learner-delegates') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i><span>Learner Delegates</span>
                </a>
                <a href="{{ route('crm.leads.index') }}" class="tb-link {{ Request::is('crm/leads') || Request::is('crm/leads/*') ? 'active' : '' }}">
                    <i class="fas fa-address-book"></i><span>Leads</span>
                </a>
                <div class="dropdown position-static">
                    <a href="#"
                       class="tb-link dropdown-toggle d-flex align-items-center {{ Request::is('crm/email_mappings*') || Request::is('crm/email_templates*') || Request::is('crm/email_triggers*') ? 'active' : '' }}"
                       id="emailDropdown"
                       data-bs-toggle="dropdown"
                       data-bs-boundary="viewport"
                       data-bs-offset="0,8"
                       aria-expanded="false">
                        <i class="fas fa-envelope"></i>
                        <span>Email</span>
                    </a>

                    <ul class="dropdown-menu shadow-lg border-0 rounded-3 py-2 mt-2" aria-labelledby="emailDropdown" style="min-width: 220px;">
                        <li>
                            <a class="dropdown-item email-tab-link d-flex align-items-center gap-2 py-2 px-3" data-tab="#tab-triggers">
                                <i class="fas fa-bolt text-warning"></i>
                                <span>Triggers</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item email-tab-link d-flex align-items-center gap-2 py-2 px-3" data-tab="#tab-templates">
                                <i class="fas fa-file-alt text-info"></i>
                                <span>Templates</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item email-tab-link d-flex align-items-center gap-2 py-2 px-3" data-tab="#tab-mappings">
                                <i class="fas fa-random text-success"></i>
                                <span>Mappings</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="{{ route('crm.newsletters.index') }}" class="tb-link {{ Request::is('crm/newsletters*') ? 'active' : '' }}">
                    <i class="fas fa-envelope-open"></i><span>Newsletters</span>
                </a>
            </div>
        </nav>

        <div class="tb-actions">
            <button class="tb-btn" type="button" data-bs-toggle="collapse" data-bs-target="#quickMenu" aria-expanded="false" aria-controls="quickMenu">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <div class="collapse" id="quickMenu">
        <div class="quickmenu-shell container-fluid py-3">
            <div class="d-flex flex-wrap gap-2 gap-sm-3 justify-content-center">
                <a href="{{ route('crm.dashboard.index') }}" class=" qm-pill btn btn-outline-primary btn-sm {{ Request::is('crm/dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home me-1"></i> Dashboard
                </a>
                <a href="{{ route('crm.customers.index') }}" class="qm-pill btn btn-outline-primary btn-sm {{ Request::is('crm/customers') ? 'active' : '' }}">
                    <i class="fas fa-users me-1"></i> Customers
                </a>
                <a href="{{ route('crm.training-courses.index') }}" class="qm-pill btn btn-outline-primary btn-sm {{ Request::is('crm/training-courses') ? 'active' : '' }}">
                    <i class="fas fa-book-open me-1"></i> Training Courses
                </a>
                <a href="{{ route('crm.learner.delegates.index') }}" class="qm-pill btn btn-outline-primary btn-sm {{ Request::is('crm/learner-delegates') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate me-1"></i> Learner Delegates
                </a>
                <a href="{{ route('crm.leads.index') }}" class="qm-pill btn btn-outline-primary btn-sm {{ Request::is('crm/leads') || Request::is('crm/leads/*') ? 'active' : '' }}">
                    <i class="fas fa-address-book me-1"></i> Leads
                </a>
                <a href="javascript:void(0)" class=" qm-pill btn btn-outline-primary btn-sm email-tab-link" data-tab="#tab-triggers">
                    <i class="fas fa-bolt me-1"></i> Email Triggers
                </a>
                <a href="javascript:void(0)" class=" qm-pill btn btn-outline-primary btn-sm email-tab-link" data-tab="#tab-templates">
                    <i class="fas fa-file-alt me-1"></i> Email Templates
                </a>
                <a href="javascript:void(0)" class=" qm-pill btn btn-outline-primary btn-sm email-tab-link" data-tab="#tab-mappings">
                    <i class="fas fa-random me-1"></i> Email Mappings
                </a>
                <a href="{{ route('crm.newsletters.index') }}" class="tb-link {{ Request::is('crm/newsletters*') ? 'active' : '' }}">
                    <i class="fas fa-envelope-open"></i><span>Newsletters</span>
                </a>
            </div>
        </div>
    </div>
</header>
