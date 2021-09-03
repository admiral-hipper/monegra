@extends('layouts.app')

<!-- ============================================================== -->
<!-- Preloader - style you can find in spinners.css -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Login box.scss -->
<!-- ============================================================== -->
@section('content-layout')
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
         style="background:url({{ asset('adminmart/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
        <div class="row auth-box" style="box-shadow: none;">
            <div class="col-lg-6 col-md-5 modal-bg-img" style="background-image: url('https://images.unsplash.com/photo-1592496001020-d31bd830651f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1686&q=80');">
                <a href="{{ route('site') }}" style="width: 100%;height: 100%;position: absolute;"></a>
            </div>
            @yield('content')
        </div>
    </div>
@endsection
<!-- ============================================================== -->
<!-- Login box.scss -->
<!-- ============================================================== -->
