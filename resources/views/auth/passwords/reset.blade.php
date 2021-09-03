@extends('layouts.auth')

@section('content')
    <div class="col-lg-6 col-md-7 bg-white">
        <div class="p-3">
            <h2 class="mt-3 text-center">@lang('Password recovery')</h2>
            <p class="text-center">@lang('Create a new password of at least 8 characters. A strong password is a combination of letters, numbers, and punctuation.')</p>
            <form class="mt-4" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="row">
                    <div class="col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label class="text-dark" for="email">@lang('Mail')</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="password">@lang('Password')</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="text-dark" for="password-confirm">@lang('Password confirmation')</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-dark">@lang('Restore password')</button>
                    </div>
                    <div class="col-lg-12 text-center mt-4">
                        @lang('Remember your password?') <a href="{{ route('login') }}" class="text-danger">@lang('Sign In')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
