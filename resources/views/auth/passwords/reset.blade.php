@extends('layouts.master')

@section('site_title')
Resetting Password
@endsection

@section('resetPassword')
<div class="page">
	<div class="page-content h-100">
        <div class="background color-light bg-primary"></div>
        <div class="row mx-0">
	        <div class="col">
	            <img src="{{ config('app.cdn') }}images/white-logo.png" alt="" class="login-logo">
	            <h1 class="login-title"><small>Keep it</small><br>Safe</h1>
	        </div>
	    </div>
        <div class="row">
        	<div class="col-12">
                <div class="card rounded-0 border-0 bg-primary">
                    <div class="card-header">
                    </div>
                    <div class="card-body text-white">
                    <form action="{{ route('password.update') }}" method="post" class="">
                    	@csrf
                    	{{-- Email --}}
                        <h3 class="f-light mb-3 text-white">Step 2</h3>
                        <div class="row">
                            <div class="col-12 w-100">
                                <label>{{ __('E-Mail Address') }}</label>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" id="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} text-white" value="{{ $email ?? old('email') }}" required autofocus>
                                </div>

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback text-white">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                    	{{-- Password --}}
                        <h3 class="f-light mb-3 text-white">Step 3</h3>
                        <div class="row">
                            <div class="col-12 w-100">
                                <label>{{ __('Password') }}</label>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} text-white" required>
                                </div>

                                @if ($errors->has('password'))
                                    <div class="invalid-feedback text-white">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </div>
                                @endif
                            </div>
                            <div class="col-12 w-100">
                                <label>{{ __('Confirm Password') }}</label>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="password" id="password-confirm" name="password-confirm" class="form-control text-white" required>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-block mb-1 btn-light text-primary px-4">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection