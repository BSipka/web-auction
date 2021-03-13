@extends('layouts.app')
@section('content')
 <div class="container">
<div class="col-md-9 col-lg-9 pull-left">

    <img src="/{{$item->image}}" alt="" style="width: 200px; height:200px; border:2px solid black">
    <h1 class="display-4 fw-normal">{{$item->name}}</h1>
    <p class="lead fw-normal">{{$item->description}}</p>
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
      <a class="btn btn-secondary" href="#">No Active auctions for this item</a>
      <br/>
      @endif
   <!-- <a class="btn btn-outline-secondary" href="#">Coming soon</a> -->
</div>
 

<!-- <div class="p-4 mb-3 bg-light rounded">
  <h4 class="fst-italic">About</h4>
  <p class="mb-0">Saw you downtown singing the Blues. Watch you circle the drain. Why don't you let me stop by? Heavy is the head that <em>wears the crown</em>. Yes, we make angels cry, raining down on earth from up above.</p>
</div> -->


<div class="p-4 pull-right">
    <h4 class="fst-italic">Items management</h4>
    <ol class="list-unstyled">
        
      <li><a class="btn btn-primary" href="{{route('items.index')}}">List of my items</a></li>
      <br/>
      <li><a class="btn btn-warning" href="{{route('items.create')}}">Create new item</a></li>
      <br/>
      <li><a class="btn btn-secondary" href="{{route('items.edit',$item->id)}}">Edit item</a></li>
      <br/>
      <li><a class="btn btn-danger" onclick="
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
      
      </li>
    </ol>
</div>

  

<div class="p-4">
  <h4 class="fst-italic">Members</h4>
  <ol class="list-unstyled mb-0">
    <li><a href="#">March 2014</a></li>
    <li><a href="#">February 2014</a></li>
    <li><a href="#">January 2014</a></li>
    <li><a href="#">December 2013</a></li>
    <li><a href="#">November 2013</a></li>
    <li><a href="#">October 2013</a></li>
    <li><a href="#">September 2013</a></li>
    <li><a href="#">August 2013</a></li>
    <li><a href="#">July 2013</a></li>
    <li><a href="#">June 2013</a></li>
    <li><a href="#">May 2013</a></li>
    <li><a href="#">April 2013</a></li>
  </ol>
</div>


</div>
</div>
@endsection