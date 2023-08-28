<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

    <style>
        #eye_slash:hover,
        #eye:hover {
            cursor: pointer;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <span><b>Admin</b>LTE</span>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign In untuk memulai sesi kamu.</p>
                <form action="{{ route('user.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-1">
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid @enderror" placeholder="Email" required
                            autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-2">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" id="signin_password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                            required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-eye-slash" id="eye_slash"></span>
                                <span class="fas fa-eye d-none" id="eye"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-5">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js/') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js/') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        var Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 4000
        });

        $('#eye_slash').click(function(e) {
            e.preventDefault();
            $('#eye').toggleClass('d-none');
            $('#eye_slash').toggleClass('d-none');
            $('#signin_password').attr('type', 'text');
        });

        $('#eye').click(function(e) {
            e.preventDefault();
            $('#eye_slash').toggleClass('d-none');
            $('#eye').toggleClass('d-none');
            $('#signin_password').attr('type', 'password');
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
</body>

</html>
