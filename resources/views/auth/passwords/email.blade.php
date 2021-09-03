@extends('layouts.auth')

@section('content')
    <div class="col-lg-6 col-md-7 bg-white">
        <div class="p-3">
            <h2 class="mt-3 text-center">@lang('Password recovery')</h2>
            <p class="text-center">@lang('Enter your email and an email will be sent to it with a link to reset your password.')</p>
            <form class="mt-4" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="text-dark" for="uname">@lang('Mail')</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="uname" type="text" placeholder="@lang('Enter mail')" name="email" value="{{ $email ?? old('email') }}" required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-dark">@lang('Send')</button>
                    </div>
                    <div class="col-lg-12 text-center mt-4">
                        @lang('Remember your password?') <a href="{{ route('login') }}" class="text-danger">@lang('Sign In')</a>
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                        <a href="{{ route('site') }}" class="text-primary">@lang('To main')</a> / <a href="{{ route('site.promo') }}" class="text-primary">@lang('Presentation')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
