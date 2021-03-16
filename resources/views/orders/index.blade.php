@extends('layouts.app')
@section('content')
 <div class="container">
    <div class="col-8 p-3">
       
        @foreach($orders as $order)    
        <ul class="list-group  mt-3">
          <li class="list-group-item bg-dark"> <img src="/{{$order->item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black"></li>
          <li class="list-group-item text-light bg-dark">{{$order->from}}</li>
          <li class="list-group-item text-light bg-dark">{{$order->to}}</li>
          <li class="list-group-item text-light bg-dark">{{$order->order_details}}</li>
          <li class="list-group-item text-light bg-dark">{{$order->created_at}}</li>
          <li class="list-group-item text-light bg-dark"><a class="btn btn-primary" href="{{route('orders.show',[$order->id])}}">Show order</a></li>
          <li class="list-group-item text-light bg-dark">
            <a class="btn btn-danger " onclick="
                                          var result = confirm('Sure you want to cancel the auction??');
                                                if(result){
                                               event.preventDefault();
                                               document.getElementById('delete-form').submit();
                                               }
                                                " href="#" >Clear from list</a>
                                              <form id="delete-form" 
                                              action="{{route('orders.destroy',[$order->id])}}"
                                                    method="POST"
                                               style="display: none"
                                                        >
                                  <input type="hidden" name="_method" value="delete">
                                                {{ csrf_field() }}
   
                                                  </form>
            </li>
          
        </ul>
        @endforeach   
       
    </div>
 </div>
@endsection