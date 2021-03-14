@extends('layouts.app')
@section('content')
 <div class="container">
      <h3 class="panel-title">{{$category_name}}</h3>
      <form class="form" method="GET" action="{{route('auctions.search')}}">
        <input type="hidden" name="_method" value="get">
        {{ csrf_field() }}
          <div class="form-group">
        <label for="category-content"></label>
        <select name="category_id" class="form-group">
          <option value="">All categories</option>
            @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
            <div class="form-group">
              <input type="submit" class="btn btn-outline-success" value="Search"/>
          </div>
        </select>
        </div> 
    </form>
   
    @foreach($auctions as $auction)
      
  
             <div class="col-12 p-3 m-6">
               
            
              <ul class="list-group ">
                <li class="list-group-item bg-dark"> <img src="/{{$auction->item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black"></li>
                <li class="list-group-item text-success bg-dark display-4 ">Time remaining : {{Carbon\Carbon::now()->diffInDays($auction->valid_until)}} days left!</li>
                <li class="list-group-item text-light bg-dark">{{$auction->item->name}}</li>
                <li class="list-group-item text-light bg-dark">{{$auction->item->description}}</li>
                <li class="list-group-item text-light bg-dark">{{$auction->item->category->category_name}}</li>
                <li class="list-group-item text-light bg-dark">{{$auction->item->starting_price}}</li>
                <li class="list-group-item text-light bg-dark">{{$auction->item->max_price}}</li>
                <li class="list-group-item text-light bg-dark">{{$auction->item->seller->name}}</li>
                <li class="list-group-item bg-dark">
                  <h3 class="text text-success"> Current price : {{$auction->largest_bid}} </h3>
                  @if(Auth::check() && Auth::user()->id != $auction->item->seller_id)
                         <a class="btn btn-primary btn-block" href="{{route('auctions.show',$auction->id)}}">Bid</a>
                  @elseif(Auth::check())
                          <a class="btn btn-warning btn-block" href="{{route('items.show',$auction->item_id)}}">Check the product</a>
                          <a class="btn btn-danger btn-block" onclick="
                                                var result = confirm('Sure you want to cancel the auction??');
                                                      if(result){
                                                     event.preventDefault();
                                                     document.getElementById('delete-form').submit();
                                                     }
                                                      " href="#" >Cancel auction</a>
                                                    <form id="delete-form" 
                                                    action="{{route('auctions.destroy',[$auction->id])}}"
                                                          method="POST"
                                                     style="display: none"
                                                              >
                                        <input type="hidden" name="_method" value="delete">
                                                      {{ csrf_field() }}
         
                                                        </form> 
                  @endif
                  
               
    
                </li>
              </ul>
           </div>
 
              @endforeach 
             
            </div>
          </div>
  @endsection