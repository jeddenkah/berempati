@extends('layouts.main')
@section('title', 'Login')
@section('header')
<div class="header-body text-center mb-7">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 class="text-white">Welcome!</h1>
            <p class="text-lead text-white">Use these awesome forms to login or create new account in your
                project for free.</p>
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-5 col-md-7">
        <div class="card bg-secondary border-0 mb-0">

            <div class="card-body px-lg-5 pb-lg-3">
                <div class="text-center text-muted mb-4">
                   {{ __('Login') }}
                </div>
                <form role="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                type="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                                autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                            </div>
                            <input class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                type="password" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <input class="custom-control-input" id="remember" type="checkbox" name="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">
                            <span class="text-muted">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary my-4">{{ __('Login') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-6">
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-light"><small>{{ __('Forgot password?') }}</small></a>
                @endif
            </div>
            <div class="col-6 text-right">
                @if (Route::has('register'))

                <a href="{{ route('register') }}" class="text-light"><small>{{__('Create new account')}}</small></a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
