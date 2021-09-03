@extends('layouts.auth')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg==" crossorigin="anonymous" />
    <style>
        .iti {
            display: inherit;
        }
    </style>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js" integrity="sha512-kkBkPRO6dSkCJDPNpW4Bb/1Z585gN++HKcIpClQW9IYI+4gk4yPC+eaE3CSQp3Ex+48NvzUvqmroZtR4gZnt4g==" crossorigin="anonymous"></script>
    <script>
        $(function () {
            window.intlTelInput($('#uphone').get(0), {
                preferredCountries: ['ru', 'ua', 'kz', 'by'],
                autoPlaceholder: 'aggressive',
                autoHideDialCode: false,
                nationalMode: false,
                initialCountry: "auto",
                geoIpLookup: function(callback) {
                    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        callback(countryCode);
                    });
                },
                formatOnDisplay: false,
                utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/utils.min.js'
            });
        });
    </script>
@endsection

@section('content')
    <div class="col-lg-6 col-md-7 bg-white">
        <div class="p-3">
            <h2 class="mt-3 text-center">@lang('Registration')</h2>
            <p class="text-center">@lang('Fill in the fields below to gain access to your personal account.')</p>

            @if ($referral)
                <p class="text-center" style="font-weight: 500;">@lang('Referred by') <span>{{ $referral->getFullName() }}</span></p>
            @endif

            <form class="mt-4" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="uname">@lang('Name')</label>
                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="uname"
                                   type="text" placeholder="@lang('Enter name')" name="name" value="{{ old('name') }}"
                                   required>
                            @if ($errors->has('name'))
                                <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="usurname">@lang('Surname')</label>
                            <input class="form-control {{ $errors->has('surname') ? 'is-invalid' : '' }}" id="usurname"
                                   type="text" placeholder="@lang('Enter surname')" name="surname" value="{{ old('surname') }}"
                                   required>
                            @if ($errors->has('surname'))
                                <div class="invalid-feedback">{{ $errors->first('surname') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="uphone">@lang('Phone')</label>
                            <div class="clearfix"></div>
                            <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" id="uphone"
                                   type="text" placeholder="@lang('Enter phone')" name="phone" value="{{ old('phone') }}"
                                   data-mask="+000000000000000" required>
                            @if ($errors->has('phone'))
                                <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="uemail">@lang('Mail')</label>
                            <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="uemail"
                                   type="email" placeholder="@lang('Enter mail')" name="email" value="{{ old('email') }}"
                                   required>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="pwd">@lang('Password')</label>
                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="pwd"
                                   type="password" placeholder="@lang('Enter password')" name="password" required>
                            @if ($errors->has('password'))
                                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="text-dark" for="pwd_confirm">@lang('Confirm password')</label>
                            <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                   id="pwd_confirm" type="password" placeholder="@lang('Confirm password')"
                                   name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn btn-block btn-dark">@lang('Sign up')</button>
                    </div>
                    <div class="col-lg-12 text-center mt-4">
                        @lang('Already have an account?') <a href="{{ route('login') }}" class="text-danger">@lang('Login to your account')</a>
                    </div>
                    <div class="col-lg-12 text-center mt-2">
                        <a href="{{ route('site') }}" class="text-primary">@lang('To main')</a> / <a href="{{ route('site.promo') }}" class="text-primary">@lang('Presentation')</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
