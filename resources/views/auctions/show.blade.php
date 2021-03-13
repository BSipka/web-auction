@extends('layouts.app')
@section('content')
<div>
    <h1 class="text text-success">Current price :{{$auction->largest_bid}}</h1>
    <h1 class="text text-info">Created at :{{$auction->created_at}}</h1>
    
    <p>{{$auction->item->name}}</p>
    <p>{{$auction->item->description}}</p>
    <p>{{$auction->item->starting_price}}</p>
    <p>{{$auction->item->max_price}}</p>
    
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
</div>
@endsection