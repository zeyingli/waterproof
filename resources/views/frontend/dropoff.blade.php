@extends('layouts.master')

@section('site_title')
Dropping off Umbrella at {{ $kiosk->name }} Kiosk
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
                                @if($umbrella < 5)
                                <p class="text-danger">Low volume of umbrella at this location, please return it after used.</p>
                                @endif
                            </div>
                        </div>
                    </div>                                 
                </div>
            </div>
            <br>
            
            <form action="{{ url('/dropoff') }}/{{ $kiosk->id }}" method="post">
            	@csrf
            <button type="submit" class="btn btn-block gradient border-0 z-3">Dropoff Umbrella</button>
            </form>

            <a href="{{ url('/dashboard') }}" class="btn btn-block border-0 z-3 mt-2">Back to Kiosk Lists</a>
        </div>
	</div>
@endsection