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
                        <div class="col-md-4 offset-md-4 col-xs-10 offset-xs-1  box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header no-border">
                                    <div class="card-title text-xs-center">
                                        <div class="p-1"><img src="admin_theme//app-assets/images/logo/logo (1).png" alt="branding logo" style="width: 50%;"></div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-xs-center font-small-3 pt-2"><span>Login with Door 2 Services demo</span></h6>
                                </div>
                                <div class="card-body collapse in">
                                    <div class="card-block">
                                        <form class="form-horizontal form-simple" method="POST" action="{{ route('login') }}" novalidate>
                                            @csrf                                          
                                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Your Username" 
                                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                <div class="form-control-position">
                                                    <i class="icon-head"></i>
                                                </div>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter Password" required autocomplete="current-password">
                                                <div class="form-control-position">
                                                    <i class="icon-key3"></i>
                                                </div>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                            </fieldset>
                                            <fieldset class="form-group row">
                                                <div class="col-md-6 col-xs-12 text-xs-center text-md-left">
                                                    <fieldset>
                                                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember-me"> Remember Me</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-xs-12 text-xs-center text-md-right"><a class="btn btn-link" href="{{ route('password.request') }}">Forgot Password?</a></div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="icon-unlock2"></i> Login</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="">
                                        {{-- <p class="float-sm-left text-xs-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p>
                                        <p class="float-sm-right text-xs-center m-0">New to Robust? <a href="register-simple.html" class="card-link">Sign Up</a></p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        @include('layouts.js')
    </body>
</html>