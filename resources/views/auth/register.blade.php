@extends('layouts.main')
@section('title', 'Login')
@section('header')
<div class="header-body text-center mb-7">
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
            <h1 class="text-white">Create an account</h1>
            {{-- <p class="text-lead text-white">Use these awesome forms to login or create new account in your project for
                free.</p> --}}
        </div>
    </div>
</div>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6 col-md-8">
        <div class="card bg-secondary border-0">
            <div class="card-body px-lg-5 py-lg-5">
                <div class="text-center text-muted mb-4">
                   {{__('Sign up')}}
                </div>
                <form role="form" method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <input class="form-control @error('name') is-invalid @enderror"
                                placeholder="{{ __('Name') }}" type="text" name="name" value="{{ old('name') }}"
                                required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                            </div>
                            <input id="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="{{ __('Email') }}" type="email" name="email" value="{{ old('email') }}"
                                required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group input-group-merge input-group-alternative mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                            </div>
                            <input id="no_hp" class="form-control @error('no_hp') is-invalid @enderror"
                                placeholder="{{ __('Phone Number') }}" type="number" name="no_hp"
                                value="{{ old('no_hp') }}" required autocomplete="no_hp">
                            @error('no_hp')
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
                            <input id="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" type="password" name="password" required autocomplete="new-password">
                            @error('password')
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
                            <input id="password-confirm" class="form-control" placeholder="{{ __('Confirm Password') }}" type="password" name="password_confirmation" required autocomplete="new-password">

                        </div>
                    </div>

                    <div class="row my-4">
                        <div class="col-12">
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" id="customCheckRegister" type="checkbox" required>
                                <label class="custom-control-label" for="customCheckRegister">
                                    <span class="text-muted">I agree with the <a href="#!">Privacy Policy</a></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-4">{{__('Create account')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
