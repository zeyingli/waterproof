@extends('layouts.master')

@section('site_title')
Picking up Umbrella at {{ $kiosk->name }} Kiosk
@endsection

@section('content')
	<div class="page-content">
		<div class="container detailblock mt-5">
            <div class="row">
                <div class="col">
                    <div class="swiper-content-block right-block">
                        <a class="like-heart color-red">
                            <i class="icon material-icons">done</i>
                        </a>
                        <figure class="image-left-wrap large mb-2">
                            <img src="{{ $kiosk->img }}" alt="{{ $kiosk->location }}">
                        </figure>
                        <p class="">State College</p>
                        <h2 class="text-primary">{{ $kiosk->name }}</h2>
                        <h3 class="text-default">{{ $kiosk->location }}</h4>
                        <h3>
                            <small>Available Umbrella: </small>
                            <span class="text-primary">{{ $umbrella }}</span>
                        </h3>
                        <div class="row">
                            <div class="col w-auto friend-visited pr-0"></div>

                            <div class="col pl-0">
                                <p>Availability of umbrella may not be guaranteed at this location.</p>
                            </div>
                        </div>
                    </div>                                 
                </div>
            </div>
            <br>
            
            @if($umbrella === 0)
            	<a href="javascript:void(0)" class="btn btn-block btn-secondary border-0 z-3">Unavailable to Pickup at this Moment</a>
            @elseif(!$overdueCheck)
            	<a href="{{ url('/account/recharge') }}" class="btn btn-block btn-danger border-0 z-3">Overdue order found</a>
            @else
            <form action="{{ url('/pickup') }}/{{ $kiosk->id }}" method="post">
            	@csrf
            <button type="submit" class="btn btn-block gradient border-0 z-3">Pickup Umbrella</button>
            </form>
            @endif

            <a href="{{ url('/dashboard') }}" class="btn btn-block border-0 z-3 mt-2">Back to Kiosk Lists</a>
        </div>
	</div>
@endsection