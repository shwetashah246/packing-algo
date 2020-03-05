@extends('layouts.app')

@section('content')
   <div class="container">
      <div class="row">
         <div class="col-sm-12">
            <div class="panel panel-default">
               <div class="panel-heading">{{$order->order_number}}</div>
               <table class="table">
                  @foreach($order->orderItems as $item)
                  <tr>
                     <th>{{ $item->product->title}}</th>
                     <th>{{ $item->quantity}}</th>
                     <th>${{ $item->price}}</th>
                  </tr>
                  @endforeach 
               </table>
            </div>
         </div>
      </div>
   </div>
@endsection