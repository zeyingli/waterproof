@extends('layouts.master')

@section('site_title')
Account Activation - Step 1
@endsection

@section('content')
	<div class="page-content h-100">
        <div class="content-sticky-footer">
            <div class="row">
            	<div class="col-12">
                    <div class="card rounded-0 border-0 bg-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-7">
                                    <h5 class="card-title text-white">Welcome, {{ Auth::user()->name }}</h5>
                                </div>
                                <div class="col-5 text-right">
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Already have account?
                        			</a>
    			                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    			                    	@csrf
    			                	</form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body text-white">
                        <form action="{{ url('/account/activate') }}" method="post" class="">
                        	@csrf
                        	{{-- Username --}}
                            <h3 class="f-light mb-3 text-white">Step 1</h3>
                            <div class="row">
                                <div class="col-12 w-100">
                                    <label>Pick an Unique Username</label>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input type="text" id="username" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }} text-white" required>
                                    </div>

                                    @if ($errors->has('username'))
                                        <div class="invalid-feedback text-white">
                                            <strong>{{ $errors->first('username') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        	{{-- Phone Number --}}
                            <h3 class="f-light mb-3 text-white">Step 2</h3>
                            <div class="row">
                                <div class="col-12 w-100">
                                    <label>What's your Phone Number?</label>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control text-white" value="+1">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <input type="text" id="phone" name="phone" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }} text-white" required>
                                    </div>

                                    @if ($errors->has('phone'))
                                        <div class="invalid-feedback text-white">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- Payment Method --}}
                            <h3 class="f-light mb-3 text-white">Step 3</h3>
                            <div class="row">
                                <div class="col-12 w-100">
                                    <label>Choose your preferred payment</label>
                                </div>
                                
                                {{-- Account Balance --}}
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="payment-1" name="payment-1" value="1" checked>
                                        <label class="custom-control-label" for="payment-1">
                                            <i class="material-icons icon">account_balance</i>
                                            <p class="text-white">Account Balance <br>(Built-in)</p>
                                        </label>
                                    </div>
                                </div>

                                {{-- Credit Card --}}
                                <div class="col-6">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="payment-2" name="payment-2" value="2">
                                        <label class="custom-control-label" for="payment-2">
                                            <i class="material-icons icon">credit_card</i>
                                            <p class="text-white">Credit Card <br>(Future Plan)</p>
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <hr style="height:2px;border:0;background-color:transparent;">
                            {{-- Skip Email Verification (Demo) --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="skipVerification" name="skipVerification" value="1">
                                        <label class="custom-control-label" for="skipVerification">
                                            Skip Email Verification (Demo Only)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="terms" name="terms" value="1" required>
                                        <label class="custom-control-label" for="terms">
                                            I hereby acknowledge and agree to the <a href="javascript:void(0)" data-toggle="modal" data-target="#termsModal" class="text-white"><strong>Terms of Use and Conditions<strong></a>.
                                        </label>
                                    </div>

                                    @if ($errors->has('terms'))
                                        <div class="invalid-feedback text-white">
                                            <strong>{{ $errors->first('terms') }}</strong>
                                        </div>
                                    @endif
                                </div>      
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" class="btn btn-block mb-1 btn-light text-primary px-4">Save Information</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
	<!-- Modal -->
    <div class="modal fade mt-6" id="termsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terms of Use and Conditions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    Waterproof
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">I agree</button>
                </div>
            </div>
        </div>
    </div>
@endsection