@extends('layouts.app')
@section('content')
 
    <div class="col-8 p-3">
               
        @foreach($offers as $offer)    
        <ul class="list-group  mt-3">
          <li class="list-group-item bg-dark"> <img src="/{{$offer->item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black"></li>
          <li class="list-group-item text-success bg-dark display-5 ">Time remaining : {{Carbon\Carbon::now()->diffInDays($offer->auction->valid_until)}} days left!</li>
          <li class="list-group-item text-light bg-dark">{{$offer->user->name}}</li>
          <li class="list-group-item text-light bg-dark">{{$offer->item->name}}</li>
          <li class="list-group-item text-light bg-dark">{{$offer->bid}}</li>
        </ul>
        <li class="list-group-item text-light bg-dark"><a class="btn btn-danger" onclick="
            var result = confirm('Are you sure you want to cancel this bid?');
            if(result){
              event.preventDefault();
              document.getElementById('delete-form').submit();
            }
          " href="#" >Cancel bid</a>
          <form id="delete-form" 
          action="{{route('offers.destroy',[$offer->id])}}"
          method="POST"
          style="display: none"
          >
      <input type="hidden" name="_method" value="delete">
      {{ csrf_field() }}
     
    </form>
        @endforeach   
    </div>
 
@endsection