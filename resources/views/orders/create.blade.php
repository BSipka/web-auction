@extends('layouts.app')
@section('content')
<div class=" col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Buyout now</h3>
    <br/>
    </div>
    <div class="panel-body">
      
<ul class="list-group  mt-3">
          <li class="list-group-item bg-dark"> <img src="/{{$auction->item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black"></li>
          <li class="list-group-item text-light bg-dark">{{$auction->item->name}}</li>
          <li class="list-group-item text-light bg-dark">{{$auction->item->description}}</li>
         <li class="list-group-item text-light bg-dark">Seller : {{$auction->item->seller->name}}</li>
          <li class="list-group-item text-light bg-dark">From : {{$auction->item->seller->city}}</li>
</ul>
        <form method="POST" action="{{route('orders.store')}}">
            {{ csrf_field() }}
            
            <input 
            id="auction_id"
            value="{{$auction_id}}"
            required
            name="auction_id" 
            spellcheck="false"
            class="form-control"
            hidden="true"
       />
           
           <div class="form-group">
           <label for="shipper-content">Select Shipper</label>
           <select name="shipper_id" class="form-group">
               @foreach ($shippers as $shipper)
               <option value="{{$shipper->id}}">{{$shipper->company_name}}</option>
               @endforeach
           </select>
           </div>

           <div class="form-group">
            <label for="payment-content">Select Payment</label>
            <select name="payment_id" class="form-group">
                @foreach ($payments as $payment)
                <option value="{{$payment->id}}">{{$payment->name}}</option>
                @endforeach
            </select>
            </div>

           <div class="form-group">
               <input type="submit" class="btn btn-primary" value="Submit"/>
           </div>
 </form>
    </div>
  </div>
</div>
  @endsection