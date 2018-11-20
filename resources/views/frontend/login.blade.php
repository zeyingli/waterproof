@extends('layouts.master')

@section('content')
	<div class="view view-main view-init ios-edges" data-url="/">
            <div class="page">
            <div class="background"><img src="img/background.png" alt=""></div>
            <div class="page-content login-page">
                <div class="block">
                    <img src="img/logo.png" alt="" class="login-logo">
                    <h1 class="login-title"><small>Welcome to,</small><br>MobileUX</h1>
                </div>
                <div class="tabscontainer">
                    <div class="toolbar tabbar">
                        <div class="toolbar-inner">
                          <a href="#tab-1" class="tab-link tab-link-active">Sign in</a>
                          <a href="#tab-2" class="tab-link">Sign Up</a>
                        </div>
                    </div>
                    <div class="tabs-animated-wrap">
                        <div class="tabs">
                          <div id="tab-1" class="page-content tab tab-active">
                            <div class="row">
                                <div class="col">
                                    <div class="list no-hairlines-md inputs-logins">
                                         <ul>
                                            <li class="item-content item-input">
                                                <div class="item-media">
                                                    <i class="icon f7-icons ios-only">person</i>
                                                    <i class="icon material-icons md-only">person</i>
                                                </div>
                                                <div class="item-inner">
                                                    <div class="item-input-wrap">
                                                    <input type="text" placeholder="Username">
                                                    <span class="input-clear-button"></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item-content item-input">
                                                <div class="item-media">
                                                    <i class="icon f7-icons ios-only">lock</i>
                                                    <i class="icon material-icons md-only">lock</i>
                                                </div>
                                                <div class="item-inner">
                                                    <div class="item-input-wrap">
                                                        <input type="password" placeholder="Your password">
                                                        <span class="input-clear-button"></span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-50"></div>
                                <div class="col-50"><a href="/dashboard/"  class="col col-50 button gradient signinbuttn md-elevation-6">Sign In</a></div>
                            </div>
                              <br>
                              
                            <a href="" class="button color-white col">Forgot password?</a>
                              <br>
                          </div>
                          <div id="tab-2" class="page-content tab">
                           <div class="row">
                                <div class="col">
                                    <div class="list no-hairlines-md inputs-logins">
                                         <ul>
                                            <li class="item-content item-input">
                                                <div class="item-media">
                                                    <i class="icon f7-icons ios-only">person</i>
                                                    <i class="icon material-icons md-only">person</i>
                                                </div>
                                                <div class="item-inner">
                                                    <div class="item-input-wrap">
                                                    <input type="text" placeholder="Phone Number" value="+91 ">
                                                    <span class="input-clear-button"></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item-content item-input">
                                                <div class="item-media">
                                                    <i class="icon f7-icons ios-only">lock</i>
                                                    <i class="icon material-icons md-only">lock</i>
                                                </div>
                                                <div class="item-inner">
                                                    <div class="item-input-wrap">
                                                        <input type="password" placeholder="Your password">
                                                        <span class="input-clear-button"></span>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="item-content item-input">
                                                <div class="item-media">
                                                    <i class="icon f7-icons ios-only">lock</i>
                                                    <i class="icon material-icons md-only">lock</i>
                                                </div>
                                                <div class="item-inner">
                                                    <div class="item-input-wrap">
                                                        <input type="password" placeholder="Confirm password">
                                                        <span class="input-clear-button"></span>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-50"></div>
                                <div class="col-50"><a href="/verification/"  class="col col-50 button gradient signinbuttn md-elevation-6">Sign Up</a></div>
                            </div>
                          </div>
                        </div>
                    </div>                
                </div>
            </div>
        </div>        
        </div>
@endsection