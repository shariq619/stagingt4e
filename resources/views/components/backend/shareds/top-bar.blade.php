@php
    $loggedUser = auth()->user();
@endphp
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav align-items-center">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

        <!-- Brand Logo -->
        <a href="javascript:;" class="brand-link">
            <img src="{{ asset('frontend/img/T4E-logo_Full-Colour-e1611494943115.png') }}" height="200" width="200"
                 alt="Logo" class="img-fluid">
        </a>


        @can('view dashboard')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('backend.dashboard.index') }}" class="nav-link">{{ __('Dashboard') }}</a>
            </li>
        @endcan
        @can('see settings')
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('backend.setting.index') }}" class="nav-link">{{ __('Settings') }}</a>
            </li>
        @endcan

        @php $user = Auth::user(); @endphp

        @if (auth()->check() && auth()->user()->hasAnyRole(['Admin', 'Super Admin']))
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('crm.dashboard.index') }}" class="nav-link">{{ __('CRM') }}</a>
            </li>
        @endif


        @if(auth()->check() && auth()->user()->isImpersonated() )
            <a href="{{ route('impersonate.leave') }}" class="btn btn-warning mr-2">
                Back to Admin
            </a>
        @endif

    @if(   $user->hasSubmittedApplicationForm() && $user->hasUploadedProfilePhoto() && $user->hasUploadedDocuments()  )
            <li class="nav-item d-none d-sm-inline-block">
                <a class="btn btn-success btn-sm nav-link text-white" href="{{ route('backend.learner.dashboard') }}">
                    Login into your dashboard
                </a>
            </li>
        @endif


        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home.index') }}" class="nav-link">{{ __('View Website') }}</a>
        </li>


    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge"></span>
            </a>


            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" onclick="markAsRead('NOTIFICATION_ID')">
                    <i class="fas fa-file mr-2"></i> New notification
                    <span class="float-right text-muted text-sm">mins ago</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('backend.notifications.index') }}" class="dropdown-item dropdown-footer">See All
                    Notifications</a>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
