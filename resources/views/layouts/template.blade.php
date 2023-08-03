<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/jqvmap/jqvmap.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('template/plugins/summernote/summernote-bs4.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    {{-- BS5 --}}
    <link rel="stylesheet" href="{{ asset('template/bs/css/bootstrap.min.css') }}">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('layouts.navbar')

        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('main')

        </div>

        @include('layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    {{-- BS5 --}}
    <script src="{{ asset('template/bs/js/bootstrap.bundle.min.js') }}"></script>

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('template/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>

    <!-- Sparkline -->
    <script src="{{ asset('template/plugins/sparklines/sparkline.js') }}"></script>

    <!-- JQVMap -->
    <script src="{{ asset('template/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <!-- jQuery Knob Chart -->
    <script src="{{ asset('template/plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    <!-- daterangepicker -->
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>

    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Summernote -->
    <script src="{{ asset('template/plugins/summernote/summernote-bs4.min.js') }}"></script>

    <!-- overlayScrollbars -->
    <script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/adminlte.js') }}"></script>

    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('template/dist/js/demo.js') }}"></script> --}}

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('template/dist/js/pages/dashboard.js') }}"></script>

    <!-- SweetAlert2 -->
    <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 4000
        });
    </script>

    @if (Session('success'))
        <script>
            Toast.fire({
                icon: 'success',
                title: "Pesan,\n {{ Session('success') }}"
            })
        </script>
    @endif

    @if (Session('error'))
        <script>
            Toast.fire({
                icon: 'error',
                title: "Pesan,\n {{ Session('error') }}"
            })
        </script>
    @endif

    @if (Session('user_created'))
        <script>
            $(document).ready(function() {
                $('#tambah-instalasi').modal('show');
            });
        </script>
    @endif

    {{-- Alert Form --}}
    <script>
        $(document).ready(function() {
            let addPhoneNumber = $("#tambah-nomor-teknisi");
            let addPhoneNumberAlert = $("#tambah-nomor-teknisi-alert");

            let editPhoneNumber = $("#edit-nomor-teknisi");
            let editPhoneNumberAlert = $("#edit-nomor-teknisi-alert");

            let addUserId = $("#tambah-id-user");
            let addUserIdAlert = $("#tambah-id-user-alert");

            let addUserPhone = $("#tambah-nomor-user");
            let addUserPhoneAlert = $("#tambah-nomor-user-alert");

            addPhoneNumber.on("input", function() {
                let addPhoneNumberValue = addPhoneNumber.val().toString();
                if (addPhoneNumberValue.length > 12) {
                    addPhoneNumberAlert.removeClass("d-none");
                } else {
                    addPhoneNumberAlert.addClass("d-none");
                }
            });

            editPhoneNumber.on("input", function() {
                let editPhoneNumberValue = editPhoneNumber.val().toString();
                if (editPhoneNumberValue.length > 12) {
                    editPhoneNumberAlert.removeClass("d-none");
                } else {
                    editPhoneNumberAlert.addClass("d-none");
                }
            });

            addUserId.on("input", function() {
                let addUserIdValue = addUserId.val().toString();
                if (addUserIdValue.length > 4) {
                    addUserIdAlert.removeClass("d-none");
                } else {
                    addUserIdAlert.addClass("d-none");
                }
            });

            addUserPhone.on("input", function() {
                let addUserPhoneValue = addUserPhone.val().toString();
                if (addUserPhoneValue.length > 12) {
                    addUserPhoneAlert.removeClass("d-none");
                } else {
                    addUserPhoneAlert.addClass("d-none");
                }
            });
        });
    </script>
</body>

</html>
