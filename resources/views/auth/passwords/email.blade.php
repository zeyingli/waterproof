@extends('layouts.master')

@section('site_title')
Reset Password
@endsection

@section('resetEmail')
<div class="page">
	<div class="page-content h-100">
        <div class="background color-light bg-primary"></div>
        <div class="row mx-0">
	        <div class="col">
	            <img src="{{ config('app.cdn') }}images/white-logo.png" alt="" class="login-logo">
	            <h1 class="login-title"><small>Reset your</small><br>Password</h1>
	        </div>
	    </div>
        <div class="row">
        	<div class="col-12">
                <div class="card rounded-0 border-0 bg-primary">
                    <div class="card-header">
                    </div>
                    <div class="card-body text-white">
                	@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('password.email') }}" method="post" class="">
                    	@csrf
                    	{{-- Email --}}
                        <h3 class="f-light mb-3 text-white">Step 1</h3>
                        <div class="row">
                            <div class="col-12 w-100">
                                <label>{{ __('E-Mail Address') }}</label>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} text-white" value="{{ old('email') }}" required>
                                </div>

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback text-white">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-block mb-1 btn-light text-primary px-4">
                                {{ __('Send Password Reset Link') }}
                            </button>
                            <a href="{{ url('/login') }}" class="btn btn-link text-white btn-block text-center mt-3">Remembered the password?</a>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection