@extends('layouts.auth')

@section('content')
    <div class="col-lg-6 col-md-7 bg-white">
        <div class="p-3">
            <h2 class="mt-3 text-center">@lang('Login to the cabinet')</h2>
            <p class="text-center">@lang('Enter your email mail and password to enter your personal account.')</p>
            <form class="mt-4" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="uname">@lang('Mail')</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="uname" type="text" placeholder="@lang('Enter mail')" name="email" value="{{ $email ?? old('email') }}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="pwd">@lang('Password')</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="pwd" type="password" placeholder="@lang('Enter password')" name="password" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> @lang('Remember me')
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-dark">@lang('Sign In')</button>
                        <a class="btn btn-link text-secondary" href="{{ route('password.request') }}">@lang('Forgot your password?')</a>
                    </div>
                    <div class="col-lg-12 text-center mt-4">
                        @lang('Do not have an account yet?') <a href="{{ route('register') }}" class="text-danger">@lang('Sign up')</a>
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                        <a href="{{ route('site') }}" class="text-primary">@lang('To main')</a> / <a href="{{ route('site.promo') }}" class="text-primary">@lang('Presentation')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
