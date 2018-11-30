@extends('layouts.master')

@section('site_title')
Payment History
@endsection

@section('content')
	<div class="page-content">
        <div class="content-sticky-footer">
        	<h2 class="block-title text-center">Payment History</h2>
        	<div class="row mx-0">
                <div class="col">
                    <div id="accordion">
                    	@foreach($records as $record)
                        <div class="card mb-1 border-0 rounded-0">
                            <div class="card-header bg-primary rounded-0 py-2" id="headingOne">
                                <a href="javascript:void(0)" class="" data-toggle="collapse" data-target="#collapse{{ $record->id }}" aria-expanded="false" aria-controls="collapse{{ $record->id }}">
                                	<p class="text-white">
                                        <i class="icon material-icons">receipt</i>Order ID: 
                                        <strong>SC{!! $record->created_at->format('Ymd') !!}-{{ $record->id }}</strong>
	                                	@if($record->status === 0)
                                            <span class="badge badge-info">In Progress</span>
                                        @elseif($record->status === 1)
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($record->status === 2)
                                            <span class="badge badge-warning">Voided</span>
                                        @elseif($record->status === 3)
                                            <span class="badge badge-danger">Overdued</span>
                                        @else
                                            <span class="badge badge-default">Unknown</span>
	                                	@endif
                                	</p>
                            	</a>
                            </div>

                            <div id="collapse{{ $record->id }}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    @php
                                        $transactions = App\Models\Administration\Transaction::where('record_id', $record->id)->get();
                                    @endphp
                                    @foreach($transactions as $transaction)
                                        Transaction ID:  {!! str_limit(sha1($transaction->created_at), 15, '') !!}-{!! $transaction->id !!}
                                        <br>
                                        @php
                                            $vendors = App\Models\Administration\Vendor::where('id', $transaction->vendor_id)->select('name')->get();
                                        @endphp
                                        @foreach($vendors as $vendor)    
                                            Payment Method: {!! $vendor->name !!}
                                        @endforeach
                                        <br>
                                        Billing Amount:  {!! $transaction->amount !!}
                                        <br>
                                        @endforeach
                                    <br>
                                    Trip Started:   {{ $record->start_time->timezone('America/New_York') }} <br>
                                    Trip Ended: 	{!! $record->end_time->timezone('America/New_York') !!} <br>
                                    <br>
                                    @if($record->status === 3)
                                        <div class="row mx-0 mt-1">
                                            <div class="col align-self-end">
                                                <form action="{{ url('/account/pay') }}/{{ $record->id }}" method="post">
                                                    <input type="hidden" name="amount" id="amount" value="{!! $transaction->amount !!}">
                                                    @csrf
                                                    @if(Auth::user()->balance < $transaction->amount)
                                                        <a href="{{ url('/account/recharge') }}" class="btn btn-block btn-outline-danger">Insufficient Fund to Pay</a>
                                                    @else
                                                        <button type="submit" class="btn btn-block btn-outline-primary">Pay Now</button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
        	</div>
    	</div>
	</div>
@endsection

@section('footer_scripts')

@endsection