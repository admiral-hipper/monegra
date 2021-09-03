@extends('layouts.auth')

@section('content')
    <div class="col-lg-6 col-md-7 bg-white">
        <div class="p-3">
            <h2 class="mt-3 text-center">@lang('Confirmation of registration')</h2>
            <p class="text-center">
                @lang('A code has been sent to your mail to confirm registration, please enter it below')
            </p>

            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    @lang('A new verification code has been sent to your email address')
                </div>
            @endif

            <div class="mt-4">
                <form class="d-inline"
                      method="POST"
                      action="{{ route('verification.verify_by_code') }}">
                    @csrf

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="code">@lang('Verification code')</label>

                            <input type="text"
                                   name="code"
                                   id="code"
                                   class="form-control {{ $errors->has('code') ? 'is-invalid' : '' }}"
                                   placeholder="@lang('Enter a code')"
                                   autocomplete="off"
                                   required>
                            @if ($errors->has('code'))
                                <div class="invalid-feedback">{{ $errors->first('code') }}</div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-12 text-center">
                        <button type="submit"
                                class="btn btn-block btn-dark">@lang('Confirm mail')</button>
                    </div>
                </form>
            </div>

            <div class="mt-4 text-center">
                @lang('Did not receive your email or is the code invalid?')

                <form class="d-inline"
                      method="POST"
                      action="{{ route('verification.resend') }}">
                    @csrf

                    <button type="submit"
                            class="btn btn-link p-0 m-0 align-baseline text-danger">@lang('Resend email')</button>
                </form>

                <form class="d-inline"
                      method="POST"
                      action="{{ route('logout') }}">
                    @csrf

                    @lang('or')

                    <button type="submit"
                            class="btn btn-link p-0 m-0 align-baseline text-danger">@lang('Log out')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
