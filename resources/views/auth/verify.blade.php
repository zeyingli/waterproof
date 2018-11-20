@extends('layouts.master')

@section('site_title')
	Verification
@endsection

@section('verification')
	<div class="page">
            <div class="background"><img src="img/background.png" alt="Waterproof - Account Verification"></div>
            <header class="row m-0 fixed-header">
                <div class="left">
                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="material-icons white">keyboard_backspace</i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    	@csrf
                	</form>
                </div>
            </header>
            {{-- Verification --}}
            <div class="page-content h-100 text-center">
                <div class="verification">
                    <div class="row mx-0">
                        <div class="col">                    
                            <h3 class="text-white">Verification Required</h3><br>
                            <p class="text-white">Before proceeding, please check your email for a verification link. After verified your email address, you can click the below button to login to your new account.</p>
                        </div>
                    </div>
                    <br>
                    <div class="row mx-0">
                        <div class="col">
                            <a href="{{ url('/dashboard') }}" class="btn btn-block gradient border-0 z-3">Login to My New Account</a>
                            <br>
                            <a href="{{ route('verification.resend') }}" class="btn btn-link text-white btn-block text-center mt-3">Resend Verification Email</a>
                            @if (session('resent'))
		                        <div class="alert alert-success" role="alert">
		                            {{ __('A fresh verification link has been sent to your email address.') }}
		                        </div>
		                    @endif
                        </div>
                    </div>
                </div>

            </div>
@endsection