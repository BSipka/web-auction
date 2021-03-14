
@extends('layouts.app')
@section('content')
 <div class="container">
    <div class="col-8 p-3">
       
        @foreach($offers as $offer)    
        <ul class="list-group  mt-3">
          <li class="list-group-item bg-dark"> <img src="/{{$offer->item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black"></li>
          <li class="list-group-item text-success bg-dark display-5 ">Time remaining : {{Carbon\Carbon::now()->diffInDays($offer->auction->valid_until)}} days left!</li>
          <li class="list-group-item text-light bg-dark">{{$offer->user->name}}</li>
          <li class="list-group-item text-light bg-dark">{{$offer->item->name}}</li>
          <li class="list-group-item text-light bg-dark">{{$offer->bid}}</li>
        </ul>
        @endforeach   
       
    </div>
 </div>
@endsection