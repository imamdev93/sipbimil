<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title') | SIPBIMIL</title>

    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('admin/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('admin/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/style.css')}}" rel="stylesheet">

    <link href="{{asset('admin/css/plugins/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/plugins/select2/select2-bootstrap4.min.css')}}" rel="stylesheet">
    @stack('styles')
    @livewireStyles
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            @include('admin.layouts.sidemenu')
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            @include('admin.layouts.header')
            <div class="wrapper wrapper-content">
                @yield('content')
            </div>
            @include('admin.layouts.footer')
        </div>
    </div>

    <!-- Toast notification -->

    {{-- <div class="toast toast toast-bootstrap hide" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; top:20px; right:20px">
        <div class="toast-header">
            <i class="fa fa-square text-navy"> </i>
            <strong class="mr-auto m-l-sm">Notification</strong>
            <small>1 min ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
           Welcome to <strong>INSPINIA</strong> - Responsive Admin Theme.
        </div>
    </div> --}}

    <!-- Mainly scripts -->
    <script src="{{asset('admin/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('admin/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/js/bootstrap.js')}}"></script>
    <script src="{{asset('admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
    <script src="{{asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>

    <!-- Flot -->
    <script src="{{asset('admin/js/plugins/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('admin/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/flot/jquery.flot.spline.js')}}"></script>
    <script src="{{asset('admin/js/plugins/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('admin/js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->
    <script src="{{asset('admin/js/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{asset('admin/js/demo/peity-demo.js')}}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{asset('admin/js/inspinia.js')}}"></script>
    <script src="{{asset('admin/js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->
    <script src="{{asset('admin/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

    <!-- GITTER -->
    <script src="{{asset('admin/js/plugins/gritter/jquery.gritter.min.js')}}"></script>

    <!-- Sparkline -->
    <script src="{{asset('admin/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->
    <script src="{{asset('admin/js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS-->
    <script src="{{asset('admin/js/plugins/chartJs/Chart.min.js')}}"></script>

    <!-- Toastr -->
    <script src="{{asset('admin/js/plugins/toastr/toastr.min.js')}}"></script>

    <script src="{{asset('admin/js/plugins/select2/select2.full.min.js')}}"></script>
    @stack('scripts')
    <script>
        $(document).ready(function () {

            $(".select2_demo_3").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Salah Satu",
                allowClear: true,
                width: "100%"
            });

        });

        $(window).bind("scroll", function () {
            let toast = $('.toast');
            toast.css("top", window.pageYOffset + 20);

        });

    </script>
    @livewireScripts
</body>

</html>
