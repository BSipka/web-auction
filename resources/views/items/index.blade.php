
@extends('layouts.app')
@section('content')

  <div class="col-12 p-3">
      @foreach($items as $item)
        <ul class="list-group mt-3">
          
            <li class="list-group-item"><a class="btn btn-primary" href="{{route('items.show',$item->id)}}">
                                                   <img src="/{{$item->image}}" style="width: 50px; height:50px;">
                                                   {{$item->name}} 
                                                   {{$item->starting_price}} 
                                                   {{$item->max_price}} 
                                                   {{$item->category->category_name}}
                                                   {{$item->created_at}}</a>
                                                   @if(!$item->auction)
                                                  <form method="POST" action="{{route('auctions.store')}}">
                                                    {{ csrf_field() }}
                                                    <input 
                                                           id="item_id"
                                                           value="{{$item->id}}"
                                                           required
                                                           name="item_id" 
                                                           spellcheck="false"
                                                           class="form-control"
                                                           hidden="true"
                                                      />
                                                      <input 
                                                           id="starting_price"
                                                           value="{{$item->starting_price}}"
                                                           required
                                                           name="starting_price" 
                                                           spellcheck="false"
                                                           class="form-control"
                                                           hidden="true"
                                                      />
                                                    <div class="form-group">
                                                      <input type="submit" class="btn btn-success" value="Start Auction"/>
                                                  </div>  
                                                  </form> 
                                                  @else
                                                  
                                                  <a class="btn btn-danger ml-3" onclick="
                                          var result = confirm('Sure you want to cancel the auction??');
                                                if(result){
                                               event.preventDefault();
                                               document.getElementById('delete-form').submit();
                                               }
                                                " href="#" >Cancel auction</a>
                                              <form id="delete-form" 
                                              action="{{route('auctions.destroy',[$item->auction->id])}}"
                                                    method="POST"
                                               style="display: none"
                                                        >
                                  <input type="hidden" name="_method" value="delete">
                                                {{ csrf_field() }}
   
                                                  </form> 
                                                  <a class="btn btn-primary" href="{{route('offers.show',[$item->id])}}">Show offer for this item</a>
                                                  @endif
                                                </li>
                                                
          @endforeach
        </ul>
        <div class="mt-3">
            <a class="btn btn-primary btn-block" href="{{route('offers.index')}}">List all bids</a>
            <a class="btn btn-success  btn-block" href="{{route('items.create')}}">Add new Item</a>
        </div>
    </div>
  
  @endsection