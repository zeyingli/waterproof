@extends('layouts.master')

@section('site_title')
Register Account
@endsection

@section('login')
    <div class="page">
        <div class="page-content h-100 ">
            <div class="background color-light"><img src="img/background.png" alt=""></div>
            <div class="row mx-0">
                <div class="col">
                    <img src="{{ config('app.cdn') }}images/white-logo.png" alt="" class="login-logo">
                    <h1 class="login-title"><small>Welcome to,</small><br>Waterproof</h1>
                </div>
            </div>
            <div class="row mx-0">
                <div class="col">
                    <ul class="nav nav-tabs login-tabs mt-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link border-white text-white" href="{{ route('login') }}" role="tab" aria-selected="true">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link border-white text-white active show" data-toggle="tab" href="#signup" role="tab" aria-selected="false">Sign Up</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                            {{-- Register --}}
                            <div class="tab-pane active" id="signup" role="tabpanel">
                                <form name="register" method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="login-input-content">
                                    {{-- Name --}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">person</i></span>
                                        </div>
                                        <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Your Name" required>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{-- Email --}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">email</i></span>
                                        </div>
                                        <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email Address" required>

                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{-- Password --}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">lock</i></span>
                                        </div>
                                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    {{-- Password Confirmation --}}
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="material-icons">lock</i></span>
                                        </div>
                                        <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="row mx-0 justify-content-end no-gutters">
                                    <div class="col-6">
                                        <button name="registerBtn" type="submit" class="btn btn-block gradient border-0 z-3" data-os="ios">Sign Up</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
@endsection

@section('footer_scripts')
    <script>
        $(window).on('load', function() {
            /* sparklines */
            $(".dynamicsparkline").sparkline([5, 6, 7, 2, 0, 4, 2, 5, 6, 7, 2, 0, 4, 2, 4], {
                type: 'bar',
                height: '25',
                barSpacing: 2,
                barColor: '#a9d7fe',
                negBarColor: '#ef4055',
                zeroColor: '#ffffff'
            });

            /* gauge chart circular progress */
            $('.progress_profile1').circleProgress({
                fill: '#169cf1',
                lineCap: 'butt'
            });
            $('.progress_profile2').circleProgress({
                fill: '#f4465e',
                lineCap: 'butt'
            });
            $('.progress_profile4').circleProgress({
                fill: '#ffc000',
                lineCap: 'butt'
            });
            $('.progress_profile3').circleProgress({
                fill: '#00c473',
                lineCap: 'butt'
            });

            /*Swiper carousel */
            var mySwiper = new Swiper('.swiper-container', {
                slidesPerView: 2,
                spaceBetween: 0,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                }
            });
        });

    </script>
@endsection