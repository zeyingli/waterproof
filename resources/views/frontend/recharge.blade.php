@extends('layouts.master')

@section('site_title')
Recharge Account
@endsection

@section('recharge')
	<div class="page">
        <div class="background color-light"></div>
        <header class="row m-0 fixed-header">
            <div class="left">
                <a href="{{ url('/account') }}"><i class="material-icons">keyboard_backspace</i></a>
            </div>
        </header>
        <div class="page-content h-100 text-center">
            <div class="verification">
                <div class="row mx-0">
                    <div class="col">                    
                        <h3 class="text-white">Recharge Account</h3><br>
                        <p class="text-white">Enter the amount that you want to add into your balance. </p>
                    </div>
                </div>
                <br>
                <div class="row mx-0">
                    <div class="col">
                    	<form method="POST" action="{{ url('/account/recharge') }}">
                        @csrf
	                        <div class="form-group">
	                            <input name="amount" id="amount" type="text" placeholder="0.00" class="form-control text-center border-white text-white" required min="0.01" step=".01">
	                        </div>
	                        <button class="btn btn-block gradient border-0 z-3">Add Balance</button>
                    	</form>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection