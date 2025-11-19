<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | {{ __('Admin') }}</title>

    <x-shared.ico />


    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/1828/1828640.png" sizes="32x32">
    <link rel="icon" href="{{ asset('icon/cropped-favicon-32x32-1-32x32.png') }}" type="image/x-icon" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet"
        href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    @php
        $data = now();
    @endphp
    <link rel="stylesheet" href="{{ asset('css/dashboardUi.css') . '?' . $data }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/admin.responsive.css') . '?' . $data }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- jQuery -->
    <script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
    @stack('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <style>
        ul.navbar-nav.ml-auto li.nav-item.dropdown.show .dropdown-menu.dropdown-menu-lg.dropdown-menu-right.show {
            max-width: 400px;
            min-width: 400px;
            max-height: 570px;
            overflow-y: scroll;
        }

        .dropdown-header {
            top: 0;
            border-bottom: 1px solid #6c757d;
        }

        .dropdown-footer {
            bottom: 0;
            border-top: 1px solid #6c757d;
        }

        .dropdown-footer,
        .dropdown-header {
            position: sticky;
            background: #fff;
        }

        .notificationWrapper a span {
            display: block;
            width: 100%;
        }

        .notificationWrapper a span.float-right.text-muted.text-sm {
            padding-left: 23px;
        }

        .notificationWrapper {
            border-bottom: solid 1px #ccc;
            display: block;

            padding-bottom: 20px;
        }

        .form-group .d-flex>label {
            font-weight: 400 !important;
        }

        div#loadingSpinner,
        div#loadingSpinner2 {
            position: fixed;
            left: 0;
            right: 0;
            margin: auto;
            top: 0;
            bottom: 0;
            z-index: 99;
            background: #00000036;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        div#loadingSpinner i,
        div#loadingSpinner2 i {
            color: #007bff;
        }



        .card {
            border-radius: 20px;
        }


        /* Adjust the iframe size */
        .mfp-iframe-holder .mfp-content {
            max-width: 90%;
            /* Adjust the width (90% of viewport width) */
            max-height: 90vh;
            /* Adjust the height (90% of viewport height) */
        }

        /* Optional: Ensure iframe fills the content area */
        .mfp-iframe-scaler iframe {
            width: 100% !important;
            height: 100% !important;
        }

        .popup-pdf {
            background: #dc3545;
            color: #fff;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 100%;
            font-size: 25px;
            cursor: pointer;
        }


        .floatingpdf {
            z-index: 999;
            top: 3%;
            margin-top: -10px;
            border-radius: 100%;
        }

        .floatingpdftitle {
            z-index: 9999;
            position: relative;
            display: inline;
        }


        .floatingpdfTrainer {
            z-index: 999;
            top: 3%;
            border-radius: 100%;
            background-attachment: fixed;
            position: fixed;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <x-backend.shareds.top-bar />
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 leftSideMenu">

            <x-backend.shareds.side-menu-logo />

            <!-- Sidebar -->
            <div class="sidebar">

                <x-backend.shareds.side-menu-panel />

                <!-- Sidebar Menu -->
                <x-backend.shareds.side-menu />
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        @yield('breadcump')
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('main')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <x-backend.shareds.bottom-bar />
    </div>
    <!-- ./wrapper -->

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="{{ asset('admin') }}/plugins/moment/moment.min.js"></script>
    <script>
        // Set Moment.js locale to English
        moment.locale('en');
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin') }}/dist/js/adminlte.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- Summernote -->
    <script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>



    <script>



        function fetchNotifications() {
            $.ajax({
                url: '{{ route('backend.notifications.fetch') }}',
                method: 'GET',
                success: function(data) {
                    renderTopbarNotifications(data);   // 🔹 Render for top bar
                    renderSidebarNotifications(data);  // 🔹 Render for your custom UL
                }
            });
        }

        // Render top bar notifications (your existing code)
        function renderTopbarNotifications(data) {
            var notificationCount = data.length;
            $('.navbar-badge').text(notificationCount);

            var notificationList = '';
            data.forEach(function(notification) {
                var formattedDate = new Date(notification.created_at).toLocaleString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });
                notificationList += `
            <div class="notificationWrapper">
                <a href="${notification.data.task_url}" class="dropdown-item" onclick="markAsRead('${notification.id}')">
                    <span><i class="fas fa-file mr-2"></i> ${notification.data.message}</span>
                    <span class="float-right text-muted text-sm">${formattedDate}</span>
                </a>
                <div class="dropdown-divider"></div>
            </div>
        `;
            });

            $('.dropdown-menu').html(`
        <span class="dropdown-item dropdown-header">${notificationCount} Notifications</span>
        <div class="dropdown-divider"></div>
        ${notificationList}
        <a href="{{ route('backend.notifications.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
    `);
        }

        // Render sidebar (UL list) notifications
        function renderSidebarNotifications(data) {
            var notificationList = '';

            // ✅ Only take the latest 3
            var latestNotifications = data.slice(0, 3);

            latestNotifications.forEach(function(notification) {
                var formattedDate = new Date(notification.created_at).toLocaleString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });

                notificationList += `
                    <li class="list-item-row align-items-start">
                        <div class="notifi_text">
                            <p>${notification.data.message}</p>
                            <div><small>${notification.data.user_name ?? ''} ${formattedDate}</small></div>
                        </div>
                        <div class="notifi_btn">
                            <a href="${notification.data.task_url}" class="d-block" onclick="markAsRead('${notification.id}')">View</a>
                        </div>
                    </li>
                `;
            });

            $('.notifi_list').html(notificationList);
        }



        // resources/js/app.js or a separate JavaScript file
        {{--function fetchNotifications() {--}}
        {{--    $.ajax({--}}
        {{--        url: '{{ route('backend.notifications.fetch') }}',--}}
        {{--        method: 'GET',--}}
        {{--        success: function(data) {--}}
        {{--            var notificationCount = data.length;--}}
        {{--            $('.navbar-badge').text(notificationCount);--}}

        {{--            var notificationList = '';--}}
        {{--            data.forEach(function(notification) {--}}
        {{--                // var formattedDate = new Date(notification.created_at);--}}
        {{--                var formattedDate = new Date(notification.created_at).toLocaleString('en-US', {--}}
        {{--                    year: 'numeric',--}}
        {{--                    month: 'long',--}}
        {{--                    day: 'numeric',--}}
        {{--                    hour: '2-digit',--}}
        {{--                    minute: '2-digit',--}}
        {{--                    hour12: true--}}
        {{--                });--}}
        {{--                notificationList += `--}}
        {{--            <div class="notificationWrapper">--}}
        {{--                <a href="${notification.data.task_url}" class="dropdown-item" onclick="markAsRead('${notification.id}')">--}}
        {{--                    <span><i class="fas fa-file mr-2"></i> ${notification.data.message}</span>--}}
        {{--                    <span class="float-right text-muted text-sm">${formattedDate}</span>--}}
        {{--                </a>--}}
        {{--                <div class="dropdown-divider"></div>--}}
        {{--            </div>--}}
        {{--        `;--}}
        {{--            });--}}

        {{--            $('.dropdown-menu').html(`--}}
        {{--        <span class="dropdown-item dropdown-header">${notificationCount} Notifications</span>--}}
        {{--        <div class="dropdown-divider"></div>--}}
        {{--        ${notificationList}--}}
        {{--        <a href="{{ route('backend.notifications.index') }}" class="dropdown-item dropdown-footer">See All Notifications</a>--}}
        {{--    `);--}}
        {{--        }--}}
        {{--    });--}}
        {{--}--}}

        function markAsRead(id) {
            $.ajax({
                url: '{{ route('backend.notifications.markAsRead') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id
                },
                success: function() {
                    fetchNotifications();
                }
            });
        }

        $(document).ready(function() {
            fetchNotifications(); // Initial fetch

            // Fetch notifications every 15 seconds
            setInterval(fetchNotifications, 15000);
        });


        $(document).ready(function() {
            // PDF Popup (Using iframe)
            $('.popup-pdf').magnificPopup({
                type: 'iframe',
                fixedContentPos: true, // Keeps the popup fixed in the viewport
                fixedBgPos: true,
                overflowY: 'auto', // Adds scroll if content is taller than viewport
                removalDelay: 300, // Smooth transition
                mainClass: 'mfp-fade', // Fade effect for popup

                iframe: {
                    patterns: {
                        pdf: {
                            index: '',
                            src: '%id%' // This will directly open the PDF
                        }
                    }
                }
            });
        });
    </script>

    <!-- Magnific Popup JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

    @stack('js')
</body>

</html>
