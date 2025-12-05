<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @can('view dashboard')
            <li class="nav-item">
                <a href="{{ route('backend.dashboard.index') }}"
                    class="nav-link {{ Request::is('backend/dashboard') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        {{ __('Admin Dashboard') }}
                    </p>
                </a>
            </li>
        @endcan

        @php
            $user = auth()->user();
        @endphp

        @if ($user->hasRole('Learner'))
            @can('view learner dashboard')
                <li class="nav-item">
                    <a href="{{ route('backend.learner.dashboard') }}"
                        class="nav-link {{ Request::is('backend/learner-dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            {{ __('Learner Dashboard') }}
                        </p>
                    </a>
                </li>
            @endcan
        @endif

        @if ($user->hasRole('Trainer'))
            @can('view trainer dashboard')
                <li class="nav-item">
                    <a href="{{ route('backend.trainer.dashboard') }}"
                        class="nav-link {{ Request::is('backend/trainer-dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            {{ __('Trainer Dashboard') }}
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('backend.risk-assessments.index') }}"
                       class="nav-link {{ Request::is('backend/risk-assessments') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-check"></i>
                        <p>
                            {{ __('Trainer Risk Assessments') }}
                        </p>
                    </a>
                </li>


            @endcan
        @endif

        @if ($user->hasRole('Corporate Client'))
            @can('view client dashboard')
                <li class="nav-item">
                    <a href="{{ route('backend.client.dashboard') }}"
                        class="nav-link {{ Request::is('backend/client-dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>
                            {{ __('Client Dashboard') }}
                        </p>
                    </a>
                </li>
            @endcan
        @endif

        @can('see user')
            <li class="nav-item">
                <a href="{{ route('backend.users.index') }}"
                    class="nav-link {{ Request::is('backend/users') ? 'active' : '' }} {{ Request::is('backend/users/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{ __('User') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see roles', 'look at permissions', 'see assign permissions')
            <li
                class="nav-item {{ Request::is('backend/roles/*') ? 'menu-open' : '' }} {{ Request::is('backend/roles') ? 'menu-open' : '' }}
                {{ Request::is('backend/permissions/*') ? 'menu-open' : '' }} {{ Request::is('backend/permissions') ? 'menu-open' : '' }}
                {{ Request::is('backend/assignpermission') ? 'menu-open' : '' }} {{ Request::is('backend/assignpermission/*') ? 'menu-open' : '' }}">
                <a href="#"
                    class="nav-link {{ Request::is('backend/roles/*') ? 'active' : '' }} {{ Request::is('backend/roles') ? 'active' : '' }}
                   {{ Request::is('backend/permissions/*') ? 'active' : '' }} {{ Request::is('backend/permissions') ? 'active' : '' }}
                   {{ Request::is('backend/assignpermission') ? 'active' : '' }} {{ Request::is('backend/assignpermission/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-lock"></i>
                    <p>
                        {{ __('Role & Permission') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('see roles')
                        <li class="nav-item">
                            <a href="{{ route('backend.roles.index') }}"
                                class="nav-link
                    {{ Request::is('backend/roles') ? 'active' : '' }} {{ Request::is('backend/roles/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-tag"></i>
                                <p>{{ __('Role') }}</p>
                            </a>
                        </li>
                    @endcan
                    @can('look at permissions')
                        <li class="nav-item">
                            <a href="{{ route('backend.permissions.index') }}"
                                class="nav-link
                    {{ Request::is('backend/permissions') ? 'active' : '' }} {{ Request::is('backend/permissions/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-key"></i>
                                <p>{{ __('Permission') }}</p>
                            </a>
                        </li>
                    @endcan
                    @can('see assign permissions')
                        <li class="nav-item">
                            <a href="{{ route('backend.assignpermission.index') }}"
                                class="nav-link
                    {{ Request::is('backend/assignpermission') ? 'active' : '' }} {{ Request::is('backend/assignpermission/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-check"></i>
                                <p>{{ __('Assign permission') }}</p>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        {{--        @canany(['see category', 'see awarding_bodies', 'see qualification', 'see exam', 'see elearning_licences', 'see venue', 'see course', 'see cohorts']) --}}
        {{--            <li --}}
        {{--                class="nav-item {{ Request::is('backend/categories/*') ? 'menu-open' : '' }} {{ Request::is('backend/categories') ? 'menu-open' : '' }} --}}
        {{--        {{ Request::is('backend/courses/*') ? 'menu-open' : '' }} {{ Request::is('backend/courses') ? 'menu-open' : '' }} --}}
        {{--        {{ Request::is('backend/qualifications/*') ? 'menu-open' : '' }} {{ Request::is('backend/qualifications') ? 'menu-open' : '' }} --}}
        {{--        {{ Request::is('backend/exams/*') ? 'menu-open' : '' }} {{ Request::is('backend/exams') ? 'menu-open' : '' }} --}}
        {{--        {{ Request::is('backend/venues/*') ? 'menu-open' : '' }} {{ Request::is('backend/venues') ? 'menu-open' : '' }} --}}
        {{--        {{ Request::is('backend/awarding_bodies/*') ? 'menu-open' : '' }} {{ Request::is('backend/awarding_bodies') ? 'menu-open' : '' }} --}}
        {{--        {{ Request::is('backend/elearning_licences/*') ? 'menu-open' : '' }} {{ Request::is('backend/elearning_licences') ? 'menu-open' : '' }} --}}
        {{--        {{ Request::is('backend/cohorts/*') ? 'menu-open' : '' }} {{ Request::is('backend/cohorts') ? 'menu-open' : '' }}"> --}}
        {{--                <a href="#" --}}
        {{--                   class="nav-link {{ Request::is('backend/categories/*') ? 'active' : '' }} {{ Request::is('backend/categories') ? 'active' : '' }} --}}
        {{--        {{ Request::is('backend/courses/*') ? 'active' : '' }} {{ Request::is('backend/courses') ? 'active' : '' }} --}}
        {{--        {{ Request::is('backend/qualifications/*') ? 'active' : '' }} {{ Request::is('backend/qualifications') ? 'active' : '' }} --}}
        {{--        {{ Request::is('backend/exams/*') ? 'active' : '' }} {{ Request::is('backend/exams') ? 'active' : '' }} --}}
        {{--        {{ Request::is('backend/venues/*') ? 'active' : '' }} {{ Request::is('backend/venues') ? 'active' : '' }} --}}
        {{--        {{ Request::is('backend/awarding_bodies/*') ? 'active' : '' }} {{ Request::is('backend/awarding_bodies') ? 'active' : '' }} --}}
        {{--        {{ Request::is('backend/elearning_licences/*') ? 'active' : '' }} {{ Request::is('backend/elearning_licences') ? 'active' : '' }} --}}
        {{--        {{ Request::is('backend/cohorts/*') ? 'active' : '' }} {{ Request::is('backend/cohorts') ? 'active' : '' }}"> --}}
        {{--                    <i class="nav-icon fas fa-graduation-cap"></i> --}}
        {{--                    <p> --}}
        {{--                        {{ __('Courses') }} --}}
        {{--                        <i class="right fas fa-angle-left"></i> --}}
        {{--                    </p> --}}
        {{--                </a> --}}
        {{--                <ul class="nav nav-treeview"> --}}
        @can('see resource')
            <li class="nav-item">
                <a href="{{ route('backend.resources.index') }}"
                    class="nav-link {{ Request::is('backend/resources') ? 'active' : '' }} {{ Request::is('backend/resources/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                        <p>{{ __('Resources') }}</p>
                    </p>
                </a>
            </li>
        @endcan

        {{-- @php
            $canSeePost = Gate::allows('see post');
            $canSeeCategory = Gate::allows('see post_category');
        @endphp

        @if ($canSeePost && $canSeeCategory)
            <li
                class="nav-item {{ Request::is('backend/post-categories/*') ? 'menu-open' : '' }} {{ Request::is('backend/post-categories') ? 'menu-open' : '' }}
                    {{ Request::is('backend/posts/*') ? 'menu-open' : '' }} {{ Request::is('backend/posts') ? 'menu-open' : '' }}">
                <a href="#"
                    class="nav-link {{ Request::is('backend/post-categories/*') ? 'active' : '' }} {{ Request::is('backend/post-categories') ? 'active' : '' }}
                    {{ Request::is('backend/posts/*') ? 'active' : '' }} {{ Request::is('backend/posts') ? 'active' : '' }}">
                    <i class="fas fa-blog" style="margin-left:.05rem;font-size:1.1rem;margin-right:.2rem;color:#c2c7d0;"></i>
                    <p>
                        {{ __('Posts') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('backend.post_category.index') }}"
                            class="nav-link
            {{ Request::is('backend/post-categories') ? 'active' : '' }} {{ Request::is('backend/post-categories/*') ? 'active' : '' }}">
                            <i class="fas fa-list" style="margin-left:.05rem;font-size:1.1rem;margin-right:.2rem;color:#c2c7d0;"></i>
                            <p>{{ __('View Category') }}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.post.index') }}"
                            class="nav-link
            {{ Request::is('backend/posts') ? 'active' : '' }} {{ Request::is('backend/posts/*') ? 'active' : '' }}">
                            <i class="fab fa-usps" style="margin-left:.05rem;font-size:1.1rem;margin-right:.2rem;color:#c2c7d0;"></i>
                            <p>{{ __('View Posts') }}</p>
                        </a>
                    </li>
                </ul>
            </li>
        @endif --}}

        @can('see methodology')
            <li class="nav-item">
                <a href="{{ route('backend.methodologies.index') }}"
                    class="nav-link {{ Request::is('backend/methodologies') ? 'active' : '' }} {{ Request::is('backend/methodologies/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-project-diagram"></i>
                    <p>
                        {{ __('Methodologies') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see category')
            <li class="nav-item">
                <a href="{{ route('backend.categories.index') }}"
                    class="nav-link {{ Request::is('backend/categories') ? 'active' : '' }} {{ Request::is('backend/categories/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th-large"></i>
                    <p>
                        <p>{{ __('Categories') }}</p>
                    </p>
                </a>
            </li>
        @endcan

        @can('see awarding_bodies')
            <li class="nav-item">
                <a href="{{ route('backend.awarding_bodies.index') }}"
                    class="nav-link {{ Request::is('backend/awarding_bodies') ? 'active' : '' }} {{ Request::is('backend/awarding_bodies/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-trophy"></i>
                    <p>
                        <p>{{ __('Awarding Bodies') }}</p>
                    </p>
                </a>
            </li>
        @endcan

        @can('see qualification')
            <li class="nav-item">
                <a href="{{ route('backend.qualifications.index') }}"
                    class="nav-link {{ Request::is('backend/qualifications') ? 'active' : '' }} {{ Request::is('backend/qualifications/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-certificate"></i>
                    <p>
                        <p>{{ __('Qualifications') }}</p>
                    </p>
                </a>
            </li>
        @endcan

        @can('see exam')
            <li class="nav-item">
                <a href="{{ route('backend.exams.index') }}"
                    class="nav-link {{ Request::is('backend/exams') ? 'active' : '' }} {{ Request::is('backend/exams/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cubes"></i>
                    <p>
                        Exams
                    </p>
                </a>
            </li>
        @endcan

        @can('see elearning_licences')
            <li class="nav-item">
                <a href="{{ route('backend.elearning_licences.index') }}"
                    class="nav-link {{ Request::is('backend/elearning_licences') ? 'active' : '' }} {{ Request::is('backend/elearning_licences/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-laptop"></i>
                    <p>
                        E-learning Licences
                    </p>
                </a>
            </li>
        @endcan

        @can('see venue')
            <li class="nav-item">
                <a href="{{ route('backend.venues.index') }}"
                    class="nav-link {{ Request::is('backend/venues') ? 'active' : '' }} {{ Request::is('backend/venues/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-map-marker-alt"></i>
                    <p>
                        Venues
                    </p>
                </a>
            </li>
        @endcan

        @can('see course_tasks')
            <li class="nav-item">
                <a href="{{ route('backend.course_tasks.index') }}"
                    class="nav-link {{ Request::is('backend/course_tasks') ? 'active' : '' }} {{ Request::is('backend/course_tasks/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tasks"></i>
                    <p>
                        Course Tasks
                    </p>
                </a>
            </li>
        @endcan

        @can('see course')
            <li class="nav-item">
                <a href="{{ route('backend.courses.index') }}"
                    class="nav-link {{ Request::is('backend/courses') ? 'active' : '' }} {{ Request::is('backend/courses/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>
                        Courses
                    </p>
                </a>
            </li>
        @endcan

        @can('see cohorts')
            <li class="nav-item">
                {{--                <a href="{{ route('backend.cohorts.index') }}" --}}
                {{--                    class="nav-link {{ Request::is('backend/cohorts') ? 'active' : '' }} {{ Request::is('backend/cohorts/*') ? 'active' : '' }}"> --}}
                {{--                    <i class="nav-icon fas fa-calendar-alt"></i> --}}
                {{--                    <p> --}}
                {{--                        Cohorts --}}
                {{--                    </p> --}}
                {{--                </a> --}}

                <a href="{{ route('backend.cohorts.index', [
                    'year' => now()->year,
                    'month' => now()->month,
                    //'trainer_id' => 16,
                    //'venue_id' => 1, // Keeping your existing venue_id=1
                    'search' => '',
                    'course_id' => '',
                ]) }}"
                    class="nav-link {{ Request::is('backend/cohorts') ? 'active' : '' }} {{ Request::is('backend/cohorts/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                        Cohorts
                    </p>
                </a>


            </li>
        @endcan

        @can('see courses-bundle')
            <li class="nav-item">
                <a href="{{ route('backend.courses-bundle.index') }}"
                    class="nav-link {{ Request::is('backend/courses-bundles') ? 'active' : '' }} {{ Request::is('backend/courses-bundles*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-layer-group"></i>
                    <p>
                        Courses Bundles
                    </p>
                </a>
            </li>
        @endcan

        @can('see product')
            <li class="nav-item">
                <a href="{{ route('backend.products.index') }}"
                    class="nav-link {{ Request::is('backend/products') ? 'active' : '' }} {{ Request::is('backend/product*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        Products
                    </p>
                </a>
            </li>
        @endcan

        @can('see application-forms')
            <li class="nav-item">
                <a href="{{ route('backend.application-forms.index') }}"
                    class="nav-link {{ Request::is('backend/application-forms') ? 'active' : '' }} {{ Request::is('backend/application-forms/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>
                        {{ __('Application Forms') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see profile photo')
            <li class="nav-item">
                <a href="{{ route('backend.profile-photo.index') }}"
                    class="nav-link {{ Request::is('backend/profile-photo') ? 'active' : '' }} {{ Request::is('backend/profile-photo/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-circle"></i>
                    <p>
                        {{ __('Profile Photo') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see document uploads')
            <li class="nav-item">
                <a href="{{ route('backend.document-uploads.index') }}"
                    class="nav-link {{ Request::is('backend/document-uploads') ? 'active' : '' }} {{ Request::is('backend/document-uploads/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-id-card"></i>
                    <p>
                        {{ __('Proof of ID') }}
                    </p>
                </a>
            </li>
        @endcan

            @if ($user->hasRole('Learner'))
                @can('see learner-video-feedback')
                    <li class="nav-item has-treeview {{ Request::is('backend/video-feedback*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ Request::is('backend/video-feedback*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-video"></i>
                            <p>
                                {{ __('Video Feedback') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('backend.video-feedback.create') }}"
                                   class="nav-link {{ Request::is('backend/video-feedback') ? 'active' : '' }}">
                                    <i class="fas fa-play-circle nav-icon"></i>
                                    <p>{{ __('Record Feedback') }}</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('backend.video-feedback.my') }}"
                                   class="nav-link {{ Request::is('backend/video-feedback/my') ? 'active' : '' }}">
                                    <i class="fas fa-folder-open nav-icon"></i>
                                    <p>{{ __('My Videos') }}</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                @endcan
            @endif



        @if ($user->hasRole(['Admin', 'Super Admin']))
            <li class="nav-item has-treeview
                {{ Request::is('backend/video-feedback/list') || Request::is('backend/video-feedback/*/view') ? 'menu-open' : '' }}">
                <a href="#"
                   class="nav-link
                    {{ Request::is('backend/video-feedback/list') || Request::is('backend/video-feedback/*/view') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-video"></i>
                    <p>
                        {{ __('Learner Videos') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('backend.video-feedback.index') }}"
                           class="nav-link {{ Request::is('backend/video-feedback/list') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{ __('All Video Feedback') }}</p>
                        </a>
                    </li>

                </ul>
            </li>
        @endif



        @can('see course-pre-requisites')
            @php
                $learner = auth()->user();
                $cohorts = $learner->cohorts()->pluck('course_id')->toArray();
                $allowedCourseIds = [1, 2, 4];
                /*
                         // SIA Door Supervisor
                         // Door Supervisor Refresher
                         // Security Guard Refresher
                     */

                // Only for these 3 courses
            @endphp
            @if (array_intersect($allowedCourseIds, $cohorts) ||
                    auth()->user()->hasRole('Super Admin') ||
                    auth()->user()->hasRole('Admin'))
                <li class="nav-item">
                    <a href="{{ route('backend.course-pre-requisites.index') }}"
                        class="nav-link {{ Request::is('backend/course-pre-requisites') ? 'active' : '' }} {{ Request::is('backend/course-pre-requisites/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>{{ __('Course Pre-Requisites') }}</p>
                    </a>
                </li>
            @endif
        @endcan

        @can('see seo')
            <li class="nav-item">
                <a href="{{ route('backend.seo.index') }}"
                    class="nav-link {{ Request::is('backend/seo') ? 'active' : '' }} {{ Request::is('backend/seo*') ? 'active' : '' }}">
                    <i class="nav-icon fab fa-searchengin"></i>
                    <p>
                        SEO
                    </p>
                </a>
            </li>
        @endcan



        @can('see messages')
            <li class="nav-item">
                <a href="{{ route('backend.messages.index') }}"
                    class="nav-link {{ Request::is('backend/messages.index') ? 'active' : '' }} {{ Request::is('backend/messages.index/*') ? 'active' : '' }}">
                    <i class="nav-icon far fa-comments"></i>
                    <p>
                        {{ __('Messages') }}
                    </p>
                    <span class="badge badge-warning float-right"> {{ getTotalUnreadMessages() }}</span>
                </a>
            </li>
        @endcan


        @if (auth()->user()->hasRole('Learner'))
            <li class="nav-item">
                <a target="_blank" href="{{ route('frontend.product.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-shopping-cart"></i>
                    <p>
                        {{ __('Shop') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a target="_blank" href="{{ route('elearning.index') }}" class="nav-link">
                    <i class="nav-icon fas fa-book-open"></i>
                    <p>
                        {{ __('Book Online Course') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a target="_blank" href="{{ route('refer.friend') }}" class="nav-link">
                    <i class="nav-icon fas fa-handshake"></i>
                    <p>
                        {{ __('Become a Partner') }}
                    </p>
                </a>
            </li>
        @endif


        @if (auth()->user()->hasRole('Super Admin'))
            <li class="nav-item">
                <a href="{{ route('backend.course-evaluation-form.index') }}"
                    class="nav-link {{ Request::is('backend/course-evaluation-form') ? 'active' : '' }} {{ Request::is('backend/course-evaluation-form/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-clipboard-check"></i>
                    <p>
                        {{ __('Course Evaluation Form') }}
                    </p>
                </a>
            </li>
        @endif


        @can('see order')
            <li class="nav-item">
                <a href="{{ route('backend.order.index') }}"
                    class="nav-link {{ Request::is('backend/order') ? 'active' : '' }} {{ Request::is('backend/order/*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>
                        {{ __('Orders') }}
                    </p>
                </a>
            </li>
        @endcan

        @can('see request-forms', 'see bespoke', 'see subscribers')
            <li
                class="nav-item {{ Request::is('backend/request-forms/*') ? 'menu-open' : '' }} {{ Request::is('backend/request-forms') ? 'menu-open' : '' }}
                {{ Request::is('backend/bespoke/*') ? 'menu-open' : '' }} {{ Request::is('backend/bespoke') ? 'menu-open' : '' }}
                {{ Request::is('backend/subscribers') ? 'menu-open' : '' }} {{ Request::is('backend/subscribers/*') ? 'menu-open' : '' }}">
                <a href="#"
                    class="nav-link {{ Request::is('backend/request-forms/*') ? 'active' : '' }} {{ Request::is('backend/request-forms') ? 'active' : '' }}
                   {{ Request::is('backend/bespoke/*') ? 'active' : '' }} {{ Request::is('backend/bespoke') ? 'active' : '' }}
                   {{ Request::is('backend/subscribers') ? 'active' : '' }} {{ Request::is('backend/subscribers/*') ? 'active' : '' }}">
                    <i class="nav-icon far fa-clone"></i>
                    <p>
                        {{ __('Contact Forms') }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    <span class="badge badge-warning float-right"> {{ getTotalLeadsCount() }}</span>
                </a>
                <ul class="nav nav-treeview">
                    @can('see request-forms')
                        <li class="nav-item">
                            <a href="{{ route('backend.request-forms.index') }}"
                                class="nav-link {{ Request::is('backend/request-forms') ? 'active' : '' }} {{ Request::is('backend/request-forms/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-quote-right"></i>
                                <p>
                                    {{ __('Quotes') }}
                                </p>
                            </a>
                        </li>
                    @endcan

                    @can('see bespoke')
                        <li class="nav-item">
                            <a href="{{ route('backend.request.bespoke.index') }}"
                                class="nav-link {{ Request::is('backend/bespoke') ? 'active' : '' }} {{ Request::is('backend/bespoke/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    {{ __('Leads') }}
                                </p>
                                <span class="badge badge-warning float-right"> {{ getTotalLeadsCount() }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('see subscribers')
                        <li class="nav-item">
                            <a href="{{ route('backend.subscribers-forms.index') }}"
                                class="nav-link {{ Request::is('backend/subscribers') ? 'active' : '' }} {{ Request::is('backend/subscribers/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-mail-bulk"></i>
                                <p>
                                    {{ __('Subscribers') }}
                                </p>
                            </a>
                        </li>
                    @endcan

                    @can('see questionnaires')
                        <li class="nav-item">
                            <a href="{{ route('backend.questionnaires-forms.index') }}"
                                class="nav-link {{ Request::is('backend/questionnaire') ? 'active' : '' }} {{ Request::is('backend/questionnaire/*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    {{ __('Questionnaire Result') }}
                                </p>
                            </a>
                        </li>
                    @endcan

                    @can('see lead_form')
                        <li class="nav-item">
                            <a href="{{ route('backend.lead_form.index') }}"
                                class="nav-link {{ Request::is('backend/lead-forms') ? 'active' : '' }} {{ Request::is('backend/lead-forms/*') ? 'active' : '' }}">
                                <i class="nav-icon fab fa-wpforms"></i>
                                <p>
                                    {{ __('Banner Form') }}
                                </p>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
        @endcan

        {{--        <li class="nav-item"> --}}
        {{--            <a href="{{ route('clear-cache') }}" class="nav-link"> --}}
        {{--                <i class="nav-icon fas fa-braille"></i> --}}
        {{--                <p> --}}
        {{--                    {{ __('Clear Cache') }} --}}
        {{--                </p> --}}
        {{--            </a> --}}
        {{--        </li> --}}


        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                    {{ __('Logout') }}
                </p>
            </a>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</nav>
