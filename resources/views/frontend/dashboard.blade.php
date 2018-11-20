@extends('layouts.master')

@section('site_title')
User Dashboard
@endsection

@section('content')
	<div class="page-content">
		<nav class="tabber tabber-bottom">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-search-tab" data-toggle="tab" href="#nav-search" role="tab" aria-controls="nav-search" aria-selected="false">
                    <i class="icon material-icons">location_searching</i>
                    <span class="tabbar-label">Search</span>
                </a>
                <a class="nav-item nav-link" id="nav-pickup-tab" data-toggle="tab" href="#nav-pickup" role="tab" aria-controls="nav-pickup" aria-selected="true">
                    <!-- Different icons for iOS and MD themes -->
                    <i class="icon material-icons">flight_takeoff</i>
                    <!-- Label text -->
                    <span class="tabbar-label">Pickup</span>
                </a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">
                    <i class="icon material-icons">person</i>
                    <span class="tabbar-label">Profile</span>
                </a>
            </div>
        </nav>

        <div class="tab-content h-100" id="nav-tabContent">
        	{{-- Search --}}
        	<div class="tab-pane fade show active" id="nav-search" role="tabpanel" aria-labelledby="nav-search-tab">
                <div class="content-sticky-footer">
                    <div class="row m-0">
                        <div class="col mt-3">
                            <div class="input-group searchshadow">
                                <input type="text" class="form-control bg-white" placeholder="Find Location..." aria-label="">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text "><i class="material-icons">search</i></button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Rent & Return --}}
            <div class="tab-pane fade show" id="nav-pickup" role="tabpanel" aria-labelledby="nav-pickup-tab">
                <div class="content-sticky-footer">
                    <div class="row m-0">
                        <div class="col mt-3">
                            <div class="input-group searchshadow">
                                <input type="text" class="form-control bg-white" placeholder="Find Location 2..." aria-label="">
                                <div class="input-group-append">
                                    <button type="button" class="input-group-text "><i class="material-icons">search</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Profile --}}
        </div>
    </div>
	

@endsection

@section('footer_script')
	@if(config('settings.googleMapsAPIStatus'))
        @include('scripts.gmaps-address-lookup')
    @endif
	
@endsection