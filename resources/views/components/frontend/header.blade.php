@php
    $data = DB::table('courses')
        ->join('cohorts', 'courses.id', '=', 'cohorts.course_id')
        ->join('venues', 'cohorts.venue_id', '=', 'venues.id')
        ->select('courses.*', 'cohorts.*', 'venues.*')
        ->get();
@endphp

<style>


    /* Badge styling */
    .nav-link .badge {
        background: #ff4d4f;       /* red background */
        color: #fff;              /* white text */
        font-size: 10px;
        font-weight: bold;
        padding: 2px 6px;
        border-radius: 10px;
        margin-left: 5px;
        vertical-align: middle;
        text-transform: uppercase;
        animation: pulse 1.5s infinite;
        position: relative;
        top: -2px;
        top: -15px;
        left: -10px;
    }

    /* Pulse animation */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }


</style>

<header id="headerWrapper">
    <div class="marque" data-google-reload-ignore>
        <p data-google-reload-ignore>We’re available 24/7! Call us on <a href="tel:08082808098">0808 280 8098</a> or
            email us at <a href="mailto:info@training4employment.co.uk">info@training4employment.co.uk</a> and our team
            will be
            happy to assist you!</p>
    </div>

    <nav class="topBar">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="socialMedia">
                        <a href="https://www.linkedin.com/company/10628798"><i class="fab fa-linkedin"></i></a>
                        <a href="https://www.facebook.com/training4employmentUK"><i
                                class="fab fa-facebook-square"></i></a>
                        <a href="https://www.youtube.com/@training4employment38"><i
                                class="fa-brands fa-youtube"></i></a>
                        <a href="https://www.instagram.com/trainingforemployment/"><i class="fab fa-instagram"></i></a>


                    </div>
                </div>

            </div>
        </div>
    </nav>

    <div class="mainHeader">
        <div class="container">
            <div class="headerRow d-flex align-items-center justify-content-between">
                <div class="logo">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset('frontend/img/logo.webp') }}" alt="Training 4 employment logo" width="200"
                             height="120"
                             loading="lazy">
                    </a>
                </div>
                <div class="marqueA" data-google-reload-ignore>
                    <p data-google-reload-ignore>We’re available 24/7! Call us on <a href="tel:08082808098">0808 280
                            8098</a> or email us at <br>
                        <a href="mailto:info@training4employment.co.uk">info@training4employment.co.uk</a> and our team
                        will be happy to assist you!
                    </p>
                </div>

                @php
                    $redirectUrl = url('/'); // default

                    if (auth()->check()) {
                        if (
                            auth()->user()->hasRole('Super Admin') ||
                            auth()->user()->hasRole('Admin') ||
                            auth()->user()->hasRole('SEO')
                        ) {
                            $redirectUrl = route('backend.dashboard.index');
                        } elseif (auth()->user()->hasRole('Learner')) {
                            $redirectUrl = route('backend.learner.dashboard');
                        } elseif (auth()->user()->hasRole('Trainer')) {
                            $redirectUrl = route('backend.trainer.dashboard');
                        } elseif (auth()->user()->hasRole('Corporate Client')) {
                            $redirectUrl = route('backend.client.dashboard');
                        }
                    }
                @endphp


                <div class="menuCart">
                    {{-- <a href="{{ route('login') }}"><i class="far fa-user"></i></a> --}}
                    @guest
                        <div class="portallink">
                            <a href="{{ route('login') }}">Login to Portal</a>
                        </div>
                    @endguest

                    @auth
                        <div class="portallink">
                            <a href="{{ $redirectUrl }}">Dashboard</a>
                        </div>
                    @endauth

                    <div class="cartdata d-flex">
                        {{-- @guest
                            <a href="{{ route('login') }}"><i class="far fa-user"></i></a>
                        @endguest --}}

                        @auth
                            <div class="mr-4 dropdown-toggle text-white" data-toggle="dropdown" aria-expanded="false"
                                 style="cursor: pointer;">
                                {{ Str::ucfirst(Auth::user()->name) }}
                                <div class="dropdown-menu">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" class="dropdown-item"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log
                                        out</a>
                                </div>
                            </div>
                        @endauth

                        <a href="{{ route('cart.index') }}" class="cartLinkWrap">
                            <i class="fas fa-shopping-cart"></i>
                            <div class="cartCount">{{ cartCount() }}</div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="headerMenuBtn d-md-none d-lg-none d-xl-none d-block">
                @guest
                    <div class="mblLoginBtn">
                        <a href="{{ route('login') }}">Login to Portal</a>
                    </div>
                @endguest

                @auth
                    <div class="mblLoginBtn">
                        <a href="{{ route('backend.dashboard.index') }}">Dashboard</a>
                    </div>


                        <div class="mblLogoutBtn mt-2">
                            <form id="logout-form-mob" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mob').submit();">LogOut</a>
                        </div>


                    @endauth
            </div>
            <div class="headerMenuRow d-flex align-items-center justify-content-between">
                <div class="mobileLogo d-none">
                    <a href="{{ route('home.index') }}">
                        <img src="{{ asset('frontend/img/logo.webp') }}" alt="t4e logo" width="200" height="120"
                             loading="eager" decoding="async" fetchpriority="high">
                    </a>
                </div>
                <div class="mainMenu" id="mainMenu">
                    <button class="closeBtn" id="closeButton" type="button">&times;</button>
                    <ul class="list-unstyled m-0 p-0 d-flex">
                        <li class="mr-3 menu-item">
                            <a href="javascript:;" class="nav-link px-0">Courses By Categories <i
                                    class="fa-solid fa-chevron-down"></i></a>
                            <ul class="dropdown p-0 list-unstyled">
                                @forelse($categories as $category)
                                    <li>
                                        <a href="{{ route('courses.byCategory', $category->slug) }}"
                                           class="text-capitalize"><i class="fas fa-angle-double-right"></i>
                                            {{ $category->name ?? '' }}
                                        </a>
                                    </li>
                                @empty
                                @endforelse
                                <li>
                                    <a href="{{ route('elearning.index') }}" class="text-capitalize"><i
                                            class="fas fa-angle-double-right"></i>E-LEARNING AND BITE SIZE COURSES</a>
                                </li>
                            </ul>
                        <li class="mr-3 menu-item">
                            <a href="{{ route('home.index') }}" class="nav-link px-0">
                                Home
                            </a>
                        </li>

                        <li class="mr-3 menu-item">
                            <a href="{{ route('courses.index') }}" class="nav-link px-0">
                                Courses
                            </a>
                        </li>

                        <li class="mr-3 menu-item">
                            <a href="{{ route('course.bundle') }}" class="nav-link px-0">
                                Course Bundles <span class="badge">SALE</span>
                            </a>
                        </li>

                        <li class="mr-3 menu-item">
                            <a href="{{ route('frontend.product.index') }}" class="nav-link px-0">
                                Products
                            </a>
                        </li>

                        <li class="mr-3 menu-item">
                            <a href="javascript:;" class="nav-link px-0">Locations</a>
                            <ul class="dropdown p-0 list-unstyled">

                                @forelse($locations as $location)
                                    <li>
                                        <a href="{{ route('locations.show', $location->slug) }}"
                                           class="text-capitalize">
                                            <i class="fas fa-angle-double-right"></i>
                                            {{ $location->venue_name ?? '' }}
                                        </a>
                                    </li>
                                @empty
                                    <li>-</li>
                                @endforelse

                            </ul>
                        </li>
                        <li class="mr-3 menu-item">
                            <a href="{{ route('elearning.index') }}" class="nav-link px-0">
                                E-learning
                            </a>
                        </li>
                        <li class="mr-3 menu-item">
                            <a href="https://training4employment.co.uk/blogs/" class="nav-link px-0">
                                Blogs
                            </a>
                        </li>
                        <li class="mr-3 menu-item mbMenu d-none">
                            <a href="{{ route('corporate.training') }}" class="nav-link px-0">
                                Corporate Clients
                            </a>
                        </li>
                        <li class="mr-3 menu-item mbMenu d-none">
                            <a href="{{ route('refer.friend') }}" class="nav-link px-0">
                                Become a Partner
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="support">
                    <ul class="list-unstyled m-0 p-0 d-flex">
                        <li class="mr-3 menu-item">
                            <a href="{{ route('corporate.training') }}" class="nav-link px-0">
                                Corporate Clients
                            </a>
                        </li>
                        {{--                        <li class="mr-3 menu-item"> --}}
                        {{--                            <a href="{{ route('help.center') }}" class="nav-link px-0"><i --}}
                        {{--                                    class="far fa-question-circle"></i> --}}
                        {{--                                Help Center --}}
                        {{--                            </a> --}}
                        {{--                        </li> --}}
                        <li class="mr-3 menu-item">
                            <a href="{{ route('refer.friend') }}" class="nav-link px-0">
                                Become a Partner
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="humburger d-flex d-md-flex d-lg-none d-xl-none d-none">
                    <div class="LoginTablet mr-2 d-none d-md-block">
                        @guest
                            <div class="mblLoginBtn">
                                <a href="{{ route('login') }}"><i class="fas fa-user-circle text-white"></i></a>
                            </div>
                        @endguest

                        @auth
                            <div class="mblLoginBtn">
                                <a href="{{ route('backend.dashboard.index') }}">Dashboard</a>
                            </div>

                                <div class="mblLogoutBtn mt-2">
                                    <form id="logout-form-mob" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form-mob').submit();">LogOut</a>
                                </div>

                        @endauth
                    </div>
                    <button class="humburgerBtn" id="hamburgerButton" type="button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</header>


@push('js')
    <script>
        $(document).ready(function () {
            $('#hamburgerButton').click(function () {
                $('#mainMenu').addClass('show');
            });

            $('#closeButton').click(function () {
                $('#mainMenu').removeClass('show');
            });
        });

        $('#mainMenu li.menu-item').hover(
            function () {
                // Remove 'active' class from all menu items
                $('#mainMenu li.menu-item').removeClass('active');

                // Add 'active' class to the currently hovered menu item
                $(this).addClass('active');
            },
            function () {
                // Optionally, you can remove the active class on mouse leave
                $(this).removeClass('active');
            }
        );
    </script>
@endpush
