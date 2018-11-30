@extends('layouts.master')

@section('site_title')
Help Center
@endsection

@section('content')
	<div class="page-content">
        <div class="content-sticky-footer">
        	<h2 class="block-title text-center">Help Center</h2>
    		<div class="row mx-0">
                <div class="col">
                    <div id="accordion">
                        <div class="card mb-1 border-0 rounded-0">
                            <div class="card-header py-2" id="headingOne">
                                <a href="javascript:void(0)" class="collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                	<strong>How to pick up an umbrella from kiosk?</strong>
                            	</a>
                            </div>
                            <div id="collapseOne" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <ul>
                                    	<li>Open the “Waterproof” Application on the phone.</li>
                                    	<li>Scan the QR Code on the kiosk through the scanning system on application.</li>
                                    	<li>Kiosk will automatically unlock one of the available umbrellas.</li>
                                    	<li>Pick up the umbrella and stay dry!</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1 border-0 rounded-0">
                            <div class="card-header py-2" id="headingTwo">
                                <a href="javascript:void(0)" class=" collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <strong>How to drop off an umbrella?</strong>
                            </a>
                            </div>
                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <ul>
                                    	<li>Open the “Waterproof” Application on the phone.</li>
                                    	<li>Put back the umbrella into any unoccupied slots of the kiosk.</li>
                                    	<li>The charge will be automatically billed to your account.</li>
                                	</ul>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1 border-0 rounded-0">
                            <div class="card-header py-2" id="headingThree">
                                <a href="javascript:void(0)" class=" collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <strong>What if I don't have sufficient fund to pay for my order?</strong>
                            </a>
                            </div>
                            <div id="collapseThree" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <ul>
                                    	<li>Your account will be locked until you paid off the previous overdue order.</li>
                                    	<li><a href="{{ url('/account/recharge') }}">Recharge your account</a> with sufficient fund first.</li>
                                    	<li>Go to <a href="{{ url('/account/history') }}">"Account/Payment History"</a>, select the overdue order and choose "Pay Now".</li>
                                	</ul>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-1 border-0 rounded-0">
                            <div class="card-header py-2" id="headingThree">
                                <a href="javascript:void(0)" class="" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                <strong>Did we resolve your problem or issue?</strong>
                            </a>
                            </div>
                            <div id="collapseFour" class="collapse show" data-parent="#accordion">
                                <div class="card-body">
                                    If not, please contact us via email or phone or live chat, and we would like to help!
                                    <br><br>
                                    <strong>Contact</strong>
                                    <br>
                                    <ul>
                                    	<li>Email: <a href="mailto:waterproof@zeyingli.com">waterproof&#64;zeyingli.com</a></li>
                                    	<li>Phone: <a href="tel:4158120000">+1(415)-812-0000</a></li>
                                	</ul>
                                	<strong>Thank you for choosing Waterproof!</strong><br><br>
                                	<a href="javascript:void(0)" class="btn btn-block btn-outline-danger">Live Chat (Unavailable)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection