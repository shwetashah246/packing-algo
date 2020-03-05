@extends('layouts.app')

@push('style')
<style>
	#order-list .card-footer {
		background-color: unset; 
		border-top: 0; 
	}
	#order-list .list-group-item  {
		border: 0;
	}
</style>
@endpush
@section('content')
	<div class="container">
		<div class="row" id="order-list">
			@php
				//dump($orders->toArray())
			@endphp
			@foreach($orders as $order)
			<div class="col-sm-3 card m-3" >
				<div class="card-body">
					<h5 class="card-title">Order #{{$order->order_number}}</h5>
					<h6 class="card-subtitle mb-2 text-muted"><small> by {{ $order->customer->name }}</small></h6>
					<p class="card-text">
						<ul class="list-group">
							@foreach($order->orderItems as $item)
								<li class="list-group-item">{{ $item->product->title}} x {{ $item->quantity}}</li>
							@endforeach
						</ul>
					</p>
				</div>
				<div class="card-footer">
					<a href="{{ route('order.print',['id'=>$order->order_id])}}" style="float: right;" class="card-link">Print</a>
				</div>
			</div>
			@endforeach
		</div>
	</div>
@endsection