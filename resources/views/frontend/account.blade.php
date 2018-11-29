@extends('layouts.master')

@section('site_title')
My Account
@endsection

@section('content')

	<div class="page-content circle-background">
        <div class="content-sticky-footer">
            <div class="row mx-0 position-relative">
                <div class="col my-4">
                    <a href="javascript:void(0)" class="media user-column">
                        <div class="w-100">
                            <figure class="avatar avatar-120"><img src="{{ config('app.cdn') }}images/user.png"></figure>
                        </div>
                        <div class="media-body align-self-center ">
                            <h5 class="text-white">{{ Auth::user()->name }}</h5>
                            <p class="text-white">
                            	{{ Auth::user()->email }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mx-0">
                <div class="col text-center">
                    <h3 class="mt-3 mb-0">$ {{ Auth::user()->balance }}</h3>
                    <p class="mt-0 mb-3 color-gray">Account Balance</p>
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                             {{ session('success') }}
                             <br> Your current balance is: $ {{ Auth::user()->balance }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mx-0 mt-3">
                <div class="col">
                    <a href="{{ url('/account/recharge') }}" class="btn btn-block gradient border-0">Add Balance</a>
                </div>
                <div class="col">
                    <a href="{{ url('/account/history') }}" class="btn btn-block btn-outline-secondary">Payment History</a>
                </div>
            </div>
            
            <br>
            
            <h2 class="block-title color-dark">Recent Visited</h2>
            <div class="carosel">
                <div data-pagination='{"el": ".swiper-pagination"}' data-space-between="0" data-slides-per-view="2" class="swiper-container swiper-init swipermultiple">
                    <div class="swiper-pagination"></div>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide pt-2">
                            <div class="swiper-content-block right-block">
                                <a class="like-heart color-red">
                                    <i class="icon material-icons">favorite</i>
                                </a>
                                <p class="">PSU</p>
                                <h2><b>002&#64;IST</b></h2>
                                <p class="">E165</p>
                                <h3><span>4.6</span><small>/254 Reviews</small></h3>
                                <a href="javascript:void(0)">View Details</a>
                            </div>
                        </div>
                        <div class="swiper-slide pt-2">
                            <div class="swiper-content-block right-block">
                                <a class="like-heart color-red">
                                    <i class="icon material-icons">favorite_border</i>
                                </a>
                                <p class="">PSU</p>
                                <h2><b>001&#64;Willard</b></h2>
                                <p class="">Main</p>
                                <h3><span>4.6</span><small>/254 Reviews</small></h3>
                                <a href="javascript:void(0)">View Details</a>
                            </div>
                        </div>
 
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('footer_scripts')
	<script>
        $(window).on('load', function() {
            /*Swiper carousel */
            var mySwiper = new Swiper('.swiper-container', {
                slidesPerView: 2,
                spaceBetween: 0,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                }
            });

            /* tooltip */
            $(function() {
                $('[data-toggle="tooltip"]').tooltip()
            });

        });

    </script>
@endsection