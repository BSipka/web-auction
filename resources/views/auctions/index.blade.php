@extends('layouts.app')
@section('content')
<div class=" col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">All auctions</h3>
    <br/>
      
    </div>
    <div>
      <form method="POST" action="{{route('auctions.index')}}">
        <div class="form-group">
            <label for="category-content">Select Category</label>
            <select name="category_id" class="form-group">
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->category_name}}</option>
                @endforeach
            </select>
            </div>
 
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit"/>
            </div>
        </div>
  </form>
    </div>
    <div class="panel-body">
       
        <ul class="list-group">
      @foreach($auctions as $auction)
           
          <li class="list-group-item">
              <img src="/{{$auction->item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black">
              <h2>{{Carbon\Carbon::now()->diffInDays($auction->valid_until)}} days left!</h2>
              <p>Name : {{$auction->item->name}}</p> <br/>
              <p>Description : {{$auction->item->description}}</p> <br/> 
              <p>Category : {{$auction->item->category->category_name}}</p> <br/>
               <p>Starting price : {{$auction->item->starting_price}}</p><br/>
               <p>Maximum price : {{$auction->item->max_price}}</p> <br/> 
               <p>Seller : {{$auction->item->seller->name}}</p> <br/> 
               @if(Auth::check() && Auth::user()->id != $auction->item->seller_id)
                   <a class="btn btn-primary" href="{{route('auctions.show',$auction->id)}}">Bid</a>
                @elseif(Auth::check())
                    <a class="btn btn-warning" href="{{route('items.show',$auction->item_id)}}">Check the product</a>
                    <a class="btn btn-danger" onclick="
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
               <h3 class="text text-success"> Current price : {{$auction->largest_bid}} </h3>
          </li>
      @endforeach   
    </ul>     
    </div>
  </div>
</div>
  @endsection