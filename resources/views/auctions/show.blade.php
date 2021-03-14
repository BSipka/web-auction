@extends('layouts.app')
@section('content')
<div>
    <ul class="list-group ">
        <li class="list-group-item bg-dark"> <img src="/{{$auction->item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black"></li>
        <li class="list-group-item text-success bg-dark display-4 ">Time remaining : {{Carbon\Carbon::now()->diffInDays($auction->valid_until)}} days left!</li>
        <li class="list-group-item text-light bg-dark">{{$auction->item->name}}</li>
        <li class="list-group-item text-light bg-dark">{{$auction->item->description}}</li>
        <li class="list-group-item text-light bg-dark">{{$auction->item->category->category_name}}</li>
        <li class="list-group-item text-light bg-dark">{{$auction->item->starting_price}}</li>
        <li class="list-group-item text-light bg-dark">{{$auction->item->max_price}}</li>
        <li class="list-group-item text-light bg-dark">{{$auction->item->seller->name}}</li>
        <li class="list-group-item text-light bg-dark">
            @if(Auth::user()->id != $auction->item->seller_id)
    <form method="POST" action="{{route('auctions.update',[$auction->id])}}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="put">
        <div class="form-group">
            <label for="bid">Place your bid<span class="required">*<p class="text text-danger">(Your bid must be greater than current price.)</p></span></label>
            <input placeholder="Bid"
                   id="bid"
                   required
                   name="largest_bid" 
                   spellcheck="false"
                   class="form-control"
                   value="{{$auction->largest_bid}}"
               />
        </div>

       <div class="form-group">
           <input type="submit" class="btn btn-primary" value="Submit"/>
       </div>  
    </form>
    @endif
        </li>
    </ul>
    
    
</div>
@endsection