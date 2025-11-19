@extends('layouts.auth')

@section('title', 'Login')


@section('main')
    <style>
        .loginPageWrapper .login-box {
            width: 100%;
            padding: 0vw 4vw;
        }

        .loginPageWrapper .card {
            box-shadow: unset;
        }

        .loginPageWrapper .loginBg {
            min-height: 560px;
        }

        .loginPageWrapper .col-md-5.col-lg-5.col-12.bg-white {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .loginPageWrapper .card-body.login-card-body {
            padding: 0;
        }

        .loginBg {
            background: url('') no-repeat cover center center;
        }

        .loginPageWrapper .loginText {
            font-size: 35px;
            font-weight: 900;
            text-shadow: 0px 4px 3px rgb(0 0 0 / 20%), 0px 8px 13px rgba(0, 0, 0, 0.1), 0px 18px 23px rgba(0, 0, 0, 0.1);
            color: #292a5c;
            margin-bottom: 50px;
        }

        .loginPageWrapper input.form-control {
            border: none;
            background: #0000 !important;
            border-radius: 0;
            border-bottom: solid 1px #ccc;
        }

        .loginPageWrapper .login-box .icheck-primary {
            margin: 30px 0px !important;
        }

        .loginBgImg {
            display: none;
        }

        @media (max-width: 767px) {
            .loginPageWrapper .loginPageInner>.container .row {
                flex-direction: column-reverse;
            }

            .loginPageWrapper .loginPageInner>.container .row .loginBg {
                background: unset !important;
                min-height: auto !important;
            }

            .loginPageInner {
                padding-top: 60px;
            }

            .loginPageWrapper .login-box button.btn.btn-primary.btn-block {
                background: #0a043d;
                border: none;
            }

            .loginPageWrapper .login-box {
                padding: 50px 30px;
                width: 100%;
            }

            .loginBgImg {
                display: block;
            }
        }

        @media (max-width: 991px) {
            .loginPageWrapper .loginBg {
                min-height: 430px;
            }
        }
    </style>

    <div class="loginPageWrapper w-100">
        <div class="loginPageInner resetPassword">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-lg-5 col-12 bg-white">
                        <div class="login-box">

                            <!-- /.login-logo -->
                            <div class="card">
                                <div class="card-body login-card-body">

                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif


                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf

                                        <input type="hidden" name="token" value="{{ $token }}">

                                        <div class="form-group">
                                            <label for="email"
                                                class="col-12 col-form-label">{{ __('E-Mail Address') }}</label>

                                            <div class="col-12">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ $email ?? old('email') }}" required autocomplete="email"
                                                    autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password"
                                                class="col-12 col-form-label">{{ __('Password') }}</label>

                                            <div class="col-12">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="new-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="password-confirm"
                                                class="col-12 col-form-label">{{ __('Confirm Password') }}</label>

                                            <div class="col-12">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="new-password">
                                            </div>
                                        </div>

                                        <div class="form-group mb-0">
                                            <div class="col-md-12 mt-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Reset Password') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.login-card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-7 col-12 loginBg"
                        style="background:url({{ asset('/images/loginBgImg.png') }}) no-repeat center center/cover">
                        <img src="{{ asset('/images/loginBgImg.png') }}" class="img-fluid loginBgImg" alt="training4employment">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
