
@extends('layouts.app')
@section('content')
<div class=" col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">My Products</h3>
    <br/>
      <a class="btn btn-warning pull-right btn-small" href="{{route('items.create')}}">Add new Item</a>
      <br/>
    </div>
    <div class="panel-body">
      
        <ul class="list-group">
          @foreach($items as $item)
            <li class="list-group-item"><a class="btn btn-primary" href="{{route('items.show',$item->id)}}">{{$item->id}}
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
                                                  <a class="btn btn-danger" onclick="
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
                                                  @endif
                                                </li>
          @endforeach
        </ul>
    </div>
  </div>
</div>
  @endsection