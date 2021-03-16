@extends('layouts.app')
@section('content')
 <div class="container">
    <div class="col-8 p-3">
       
        @foreach($orders as $order)    
        <ul class="list-group  mt-3">
          <li class="list-group-item bg-dark"> <img src="" alt="" style="width: 200px; height:200px; border:2px solid black"></li>
          <li class="list-group-item text-light bg-dark">{{$order->from}}</li>
          <li class="list-group-item text-light bg-dark">{{$order->to}}</li>
          <li class="list-group-item text-light bg-dark">{{$order->order_details}}</li>
          <li class="list-group-item text-light bg-dark">{{$order->created_at}}</li>
        </ul>
        @endforeach   
       
    </div>
 </div>
@endsection