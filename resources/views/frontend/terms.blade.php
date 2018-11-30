@extends('layouts.master')

@section('site_title')
Terms of Use and Conditions
@endsection

@section('content')
	<div class="page-content">
        <div class="content-sticky-footer">
        	<h5 class="block-title text-center">Terms of Use and Conditions</h5>
            <div class="container">
                <div class="media">
                    <figure class="avatar avatar-40">
                        <img src="{{ config('app.cdn') }}images/favicon/apple-touch-icon.png?version={{ config('app.version') }}" alt="Waterproof">
                    </figure>
                    <div class="media-body">
                        <h5 class="mt-0">Service Level Agreement</h5>
                        <p class="mb-2">SLA</p>
                        The Waterproof Rental Umbrella Service Level Agreement (this SLA) is a policy governing the use of included products or services (listed below) between customer (“you” or the entity you represent) and Waterproof, and its affiliates (“Waterproof”, “we” or “our”). Waterproof reserves the right to change this SLA without any notifications in advance.<br>

                        <br>Included Products and Services<br>
                        <ul>
                        	<li>Authorized Kiosk Stations</li>
                        	<li>Registered Umbrellas</li>
                        	<li>Web/Mobile Application</li>
                        </ul>

                        <div class="media mt-4">
                            <div class="media-body">
                                <h5 class="mt-0">Service Commitment</h5>
                                <p class="mb-2 mt-3" style="font-weight:bold;">Reliability</p>
                                We shall implement industry standard AES-256 encryption algorithm to protect identical sensitive information for all of our customers. All data shall be securely stored and distributed in multiple isolated databases.
                                <p class="mb-2 mt-2" style="font-weight:bold;">Availability</p>
                                We shall use commercially reasonable efforts to maintain the included products and services with a monthly uptime percentage of at least 99.95%. However, it may not include the damaged kiosk stations, unavailable kiosk stations in certain areas, as well as unexpected downtime due to the faults of our cloud service provider.
                                <p class="mb-2 mt-2" style="font-weight:bold;">Fault Tolerance</p>
                                We shall always keep focusing on the fault tolerance improvements of our included products and services. Due to the fact that most of the weather conditions are unpredictable, and we consider all of our workloads are mission-critical. In order to minimize the possibilities of unavailable of included products and services, the performances of our infrastructures shall be detailed monitoring and reported in real-time. In terms of any kiosks’ issues, at least an assigned engineer shall be in charge and shipped to the field where abnormal activity detected. In addition, all cloud computing resources shall be fault tolerance achieved as well. Any unhealthy targets or instances shall be automatically migrated off from workloads and re-launched with healthy ones.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection