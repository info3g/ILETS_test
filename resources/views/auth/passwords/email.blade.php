<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    @include('layouts.header')
    @include('layouts.css')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column  blank-page blank-page">
    <div class="app-content content container-fluid">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                            <div class="card-header no-border pb-0">
                                <div class="card-title text-xs-center">
                                    <img src="admin_theme/app-assets/images/logo/logo (1).png" alt="branding logo">
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>We will send you a link to reset your password.</span></h6>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                <div class="alert alert-success" role="alert">{{ session('status') }}
                                </div>
                                @endif
                                <div class="card-body collapse in">
                                    <div class="card-block">
                                        <form method="GET"class="form-horizontal" action="{{ route('password.email') }}" novalidate>
                                            @csrf
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input id="email" type="email" class="form-control form-control-lg input-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Your Email Address">
                                                <div class="form-control-position">
                                                    <i class="icon-mail6"></i>
                                                </div>
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-lock4"></i> {{ __('Send Password Reset Link') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer no-border">
                            <p class="float-sm-left text-xs-center"><a href="{{ route('login') }}" class="card-link">Login</a></p>
                            <p class="float-sm-right text-xs-center">New to Robust ? <a href="register-simple.html" class="card-link">Create Account</a></p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>
</html>