@extends('layouts.master')

@section('site_title')
User Dashboard
@endsection

@section('content')
	<div class="page-content">
		<nav class="tabber tabber-bottom">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link{{ $rentalCheck ? ' active' : '' }}" id="nav-search-tab" data-toggle="tab" href="#nav-search" role="tab" aria-controls="nav-search" aria-selected="{{ $rentalCheck ? 'true' : 'false' }}">
                    <i class="icon material-icons">location_searching</i>
                    <span class="tabbar-label">Find Kiosks</span>
                </a>

                @if(!$rentalCheck)
                <a class="nav-item nav-link{{ !$rentalCheck ? ' active' : '' }}" id="nav-return-tab" data-toggle="tab" href="#nav-return" role="tab" aria-controls="nav-return" aria-selected="{{ !$rentalCheck ? 'true' : 'false' }}">
                    <!-- Different icons for iOS and MD themes -->
                    <i class="icon material-icons">flight_land</i>
                    <!-- Label text -->
                    <span class="tabbar-label">Dropoff Umbrella</span>
                </a>
                @else
                <a class="nav-item nav-link" id="nav-pickup-tab" data-toggle="tab" href="#nav-pickup" role="tab" aria-controls="nav-pickup" aria-selected="false">
                    <!-- Different icons for iOS and MD themes -->
                    <i class="icon material-icons">flight_takeoff</i>
                    <!-- Label text -->
                    <span class="tabbar-label">Pickup Umbrella</span>
                </a>
                @endif

            </div>
        </nav>

        <div class="tab-content h-100" id="nav-tabContent">
        	{{-- Search --}}
        	<div class="tab-pane fade{{ $rentalCheck ? ' show' : '' }}{{ $rentalCheck ? ' active' : '' }}" id="nav-search" role="tabpanel" aria-labelledby="nav-search-tab">
                <div class="content-sticky-footer">
                    <div class="row mt-0">
                        <div class="col m-0">
                            <div style="width:100wh;height:100vh;">
                            {!! Mapper::render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Rent --}}
            @if($rentalCheck)
            <div class="tab-pane fade" id="nav-pickup" role="tabpanel" aria-labelledby="nav-pickup-tab">
                <div class="content-sticky-footer">
                    <h2 class="block-title">Nearby Available Kiosk Stations: </h2>
                    <ul class="list-group">
                        @foreach($kiosks as $kiosk)
                        <li class="list-group-item">
                            <a href="/pickup/{{ $kiosk->id }}/" class="media">
                                <div class="w-auto h-100">
                                    <figure class="image-left-wrap smalls mr-3"><img src="{!! $kiosk->img !!}" alt="{{ $kiosk->location }}"></figure>
                                </div>
                                <div class="media-body">
                                    <h5 class="text-primary">
                                        {{ $kiosk->name }}
                                        @php
                                            $amount = App\Http\Controllers\FrontendController::countAvailableUmbrella($kiosk->id);
                                            switch($amount) {
                                                case($amount < 3):
                                                    $type = "danger";
                                                    $info = "Low capacity";
                                                break;
                                                case($amount < 5):
                                                    $type = "warning";
                                                    $info = "High demand";
                                                break;
                                                case($amount < 10):
                                                    $type = "primary";
                                                    $info = "Normal";
                                                break;
                                                case($amount <= 20):
                                                    $type = "success";
                                                    $info = "Sufficient capacity";
                                                break;
                                                default:
                                                    $type = "dark";
                                                    $info = "Unavailable";
                                                break;
                                            }
                                        @endphp
                                        <span class="badge badge-{{ $type }} ml-1">
                                            {{ $amount }} left
                                        </span>
                                    </h5>
                                    <p>{{ $kiosk->location }}</p>
                                </div>
                                @if($kiosk->status === 1)
                                <button class="like-heart color-red">
                                    <i class="icon material-icons">done</i>
                                </button>
                                @else
                                <button class="like-heart color-red">
                                    <i class="icon material-icons">report_problem</i>
                                </button>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @else
            {{-- Return --}}
            <div class="tab-pane fade{{ !$rentalCheck ? ' show' : '' }}{{ !$rentalCheck ? ' active' : '' }}" id="nav-return" role="tabpanel" aria-labelledby="nav-return-tab">
                <div class="content-sticky-footer">
                    <div class="content-sticky-footer">
                    <h2 class="block-title">Nearby Available Kiosk Stations: </h2>
                    <ul class="list-group">
                        @foreach($kiosks as $kiosk)
                        <li class="list-group-item">
                            <a href="/dropoff/{{ $kiosk->id }}/" class="media">
                                <div class="w-auto h-100">
                                    <figure class="image-left-wrap smalls mr-3"><img src="{!! $kiosk->img !!}" alt="{{ $kiosk->location }}"></figure>
                                </div>
                                <div class="media-body">
                                    <h5 class="text-primary">{{ $kiosk->name }}</h5>
                                    <p>{{ $kiosk->location }}</p>
                                </div>
                                @if($kiosk->status === 1)
                                <button class="like-heart color-red">
                                    <i class="icon material-icons">done</i>
                                </button>
                                @else
                                <button class="like-heart color-red">
                                    <i class="icon material-icons">report_problem</i>
                                </button>
                                @endif
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                </div>
            </div>
            @endif

        </div>
    </div>
	

@endsection

@section('footer_scripts')
	{!! Mapper::renderJavascript() !!}
    <script>
        $(window).on('load', function() {
            /* tooltip */
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>
@endsection