@extends('layouts.master')

@section('site_title')
Enjoy your Trip!
@endsection

@section('content')
	<div class="page-content">
        <div class="content-sticky-footer">
            <div class="block-title text-center">Successfully Picked up Umbrella!</div>
            <div class="container">
                <div class="row">
                	<div class="col-sm-12 col-md-6">
                		<div class="card mb-3">
                            <div class="card-header bg-primary">
                                <h4 class="text-center f-light text-white my-3">Be Safe!</h4>
                            </div>
                            <div class="card-body text-center">
                                <div class="mt-1">
                                	<p style="font-size:18px;">
                                	We Are <strong class="text-red">#1</strong> Shared Umbrella Service in State College!
                                	</p><br>
                                	<h5 class="text-warning my-1 w-100">
										<i class="material-icons">star</i>
										<i class="material-icons">star</i>
										<i class="material-icons">star</i>
										<i class="material-icons">star</i>
										<i class="material-icons">star</i>
									</h5>
                                	<p class="text-center">
                                		<br>
                                		<div id="countup" style="font-size:20px;">

                                			<div id="hours" style="display:inline-block;font-weight:bold;">00</div> Hours
                                			<div id="minutes" style="display:inline-block;font-weight:bold;">00</div> Minutes
                                			<div id="seconds" style="display:inline-block;font-weight:bold;">00</div> Seconds
                                		</div>
                                	</p>
                                </div>
                                <br>
                            </div>
                            <div class="card-footer">
                                <div class="media">
                                    <figure class="avatar avatar-40  rounded-circle">
                                        <img src="{{ config('app.cdn') }}images/favicon/apple-touch-icon.png?version={{ config('app.version') }}" alt="Waterproof">
                                    </figure>
                                    <div class="media-body">
                                        <h5 class="mb-1">Waterproof Inc.</h5> State College, PA
                                    </div>
                                </div>
                            </div>
                            <div>
                            	<a href="{{ url('/dashboard') }}" class="btn btn-block gradient border-0 z-3">Dropoff Umbrella</a>
                            </div>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')
	<script type="text/javascript">
		window.onload=function() {
		  upTime(new Date());
		}
		function upTime(countTo) {
		  now = new Date();
		  countTo = new Date(countTo);
		  difference = (now-countTo);

		  hours=Math.floor((difference%(60*60*1000*24))/(60*60*1000)*1);
		  mins=Math.floor(((difference%(60*60*1000*24))%(60*60*1000))/(60*1000)*1);
		  secs=Math.floor((((difference%(60*60*1000*24))%(60*60*1000))%(60*1000))/1000*1);

		  document.getElementById('hours').firstChild.nodeValue = hours;
		  document.getElementById('minutes').firstChild.nodeValue = mins;
		  document.getElementById('seconds').firstChild.nodeValue = secs;

		  clearTimeout(upTime.to);
		  upTime.to=setTimeout(function(){ upTime(countTo); },1000);
		}
	</script>
@endsection