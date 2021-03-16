@extends('layouts.app')
@section('content')
 

 <div class="row">
  <div class="col-6">
    <img src="/{{$item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black">
    <h1 class="display-5 fw-normal">{{$item->name}}</h1>
    <div class="p-4 mb-3 bg-light rounded">
      <h4 class="fst-italic">About</h4>
      <p class="mb-0">{{$item->description}}</p>
    </div>
    <div class="p-4 mb-3 bg-light rounded">
      <h4 class="fst-italic">Category</h4>
      <p class="mb-0">{{$item->category->category_name}}</p>
    </div>  
  
    @if($item->auction)
        
            <form id="delete-form" 
        action="{{route('auctions.destroy',[$item->auction->id])}}"
        method="POST"
       
        >
    <input type="hidden" name="_method" value="delete">
    {{ csrf_field() }}
    <button type="submit" class="btn btn-danger">Cancel auction</button>
          </form>
            
        
      <br/>
      @else
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
      <a class="btn btn-secondary" href="{{route('items.edit',[$item->id])}}">Edit item</a>
          <br/>
      <a class="btn btn-danger" onclick="
        var result = confirm('Are you sure you want to delete this item?');
        if(result){
          event.preventDefault();
          document.getElementById('delete-form').submit();
        }
      " href="#" >Delete</a>
      <form id="delete-form" 
      action="{{route('items.destroy',[$item->id])}}"
      method="POST"
      style="display: none"
      >
  <input type="hidden" name="_method" value="delete">
  {{ csrf_field() }}
 
</form>
      @endif
    </div>
      <div class="col-6">
      <div class="p-4 ">
        <h4 class="fst-italic">Items management</h4>
        <ol class="list-unstyled">
            
          <li><a class="btn btn-primary" href="{{route('items.index')}}">List of my items</a></li>
          <br/>
          <li><a class="btn btn-warning" href="{{route('items.create')}}">Create new item</a></li>
          <br/>
          
          
    
         
  </div>

</div>

 






@endsection