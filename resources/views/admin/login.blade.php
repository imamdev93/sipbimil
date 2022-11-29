<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | SIPBIMIL</title>

    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            @include('admin.notification')
            <div>
                <h1 class="logo-name">IN+</h1>
            </div>
            <h4>Monitoring Perkembangan Balita & Ibu Hamil</h4>
            <p>Login untuk masuk ke halaman admin</p>
            <form class="m-t" role="form" action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Masukan Password">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                {{-- <a href="#"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">Create an account</a> --}}
            </form>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('admin/js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.js') }}"></script>

</body>

</html>
