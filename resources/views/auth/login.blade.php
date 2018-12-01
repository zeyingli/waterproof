@extends('layouts.master')

@section('site_title')
Login to My Account
@endsection

@section('login')
	<div class="page">
        <div class="page-content h-100">
            <div class="background color-light"></div>
            <div class="row mx-0">
                <div class="col">
                    <img src="{{ config('app.cdn') }}images/white-logo.png" alt="Waterproof Logo" class="login-logo">
                    <h1 class="login-title"><small>Welcome to,</small><br>Waterproof</h1>
                </div>
                @include('partial.status')
            </div>
            <div class="row mx-0">
                <div class="col">
                    <ul class="nav nav-tabs login-tabs mt-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link border-white text-white active show" data-toggle="tab" href="#signin" role="tab" aria-selected="true">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-white text-white" href="{{ url('/register') }}" role="tab" aria-selected="false">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="signin" role="tabpanel">
                                <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="login-input-content">
                                   <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">person</i></span>
                                        </div>
                                        <input id="email-login" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Username/Email/Phone" autocomplete="off" required data-os="ios">

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">lock</i></span>
                                        </div>
                                        <input id="password-login" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" required data-os="ios">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mx-0 justify-content-end no-gutters">
                                    <div class="col-6">
                                        <button name="loginBtn" type="submit" class="btn btn-block gradient border-0 z-3" data-os="ios">Sign In</button>
                                    </div>
                                </div>
                                </form>
                                <a href="{{ route('password.request') }}" class="btn btn-link text-white btn-block text-center mt-3" data-os="ios">Forget Password?</a>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
@endsection

@section('footer_scripts')

@endsection