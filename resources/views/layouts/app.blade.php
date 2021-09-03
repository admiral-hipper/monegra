<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('lp/img/favicon.ico') }}" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ritofos') }}</title>

    <!-- Styles -->
    <!-- Custom CSS -->
    <link href="{{ asset('adminmart/dist/css/style.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('adminmart/assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminmart/assets/libs/morris.js/morris.css') }}" rel="stylesheet">
    <link href="{{ asset('adminmart/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminmart/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">


    <link href="{{asset('assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" >
    <link href="{{asset('csscopy/style.css')}}" rel="stylesheet">
    <link href="{{asset('csscopy/custom.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177834135-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-177834135-1');
    </script>

    <!-- App styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    @yield('styles')
</head>
<body>
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        @yield('content-layout')
    </div>

    <!-- Scripts -->

    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('adminmart/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('adminmart/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <!-- apps -->
    <script src="{{ asset('adminmart/dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('adminmart/dist/js/feather.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('adminmart/dist/js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('adminmart/dist/js/custom.min.js') }}"></script>
    <!--This page JavaScript -->
    <script src="{{ asset('adminmart/assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('adminmart/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!--
    Scripts
    -->  
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('jscopy/app-style-switcher.js')}}"></script>
    <script src="{{asset('jscopy/feather.min.js')}}"></script>
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('jscopy/sidebarmenu.js')}}"></script>
    <script src="{{asset('jscopy/custom.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('jscopy/pages/dashboards/dashboard1.min.js')}}"></script>
    <script>
        $(".preloader ").fadeOut();

        window.locale = '{!! app()->getLocale() !!}';
    </script>

    <!-- App scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        window.replainSettings = { id: '4753d969-f5ea-4aa7-a8aa-db33fe57e25a' };
        (function(u){var s=document.createElement('script');s.type='text/javascript';s.async=true;s.src=u;
            var x=document.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);
        })('https://widget.replain.cc/dist/client.js');
    </script>

    @yield('scripts')
</body>
</html>
