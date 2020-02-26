@extends('layouts.admin.admin_layout')

@section('content')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
    <div class="auth-box bg-dark">
        <div class="text-center">
            <span class="text-white">Enter your e-mail address below and we will send you instructions how to recover a password.</span>
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row mt-20">
            <!-- Form -->
            <form class="col-12" method="POST" action="{{ route('password.email') }}">
                 @csrf
                <!-- email -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-danger text-white" id="basic-addon1"><i class="ti-email"></i></span>
                    </div>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" name="email" value="{{ old('email') }}" placeholder="Email Address" aria-label="Username" required>
                    <!-- <input type="text" class="form-control form-control-lg" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1"> -->
                </div>
                <!-- pwd -->
                <div class="row m-t-20 p-t-20 border-top border-secondary">
                    <div class="col-12">
                        <a class="btn btn-success" href="{{ route('login') }}" id="to-login" name="action">Back To Login</a>
                        <button class="btn btn-info float-right" type="submit" name="action">Recover</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
