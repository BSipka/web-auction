@extends('layouts.app')
@section('content')
<div class=" col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Add Product</h3>
    <br/>
    </div>
    <div class="panel-body">
      
        <form method="POST" action="{{route('items.store')}}">
            {{ csrf_field() }}
            
            <div class="form-group">
                <label for="name">Name<span class="required">*</span></label>
                <input placeholder="Enter the name"
                       id="name"
                       required
                       name="name" 
                       spellcheck="false"
                       class="form-control"
                   />
            </div>
            <div class="form-group">
               <label for="description">Description</label>
               <textarea placeholder="Enter description"
                      style="resize:vertical"
                      id="description"
                      required
                      name="description" 
                      spellcheck="false"
                      rows="5"
                      class="form-control autosize-target text-left "
                      >
                      
            </textarea>
           </div>

           <div class="form-group">
            <label for="item-starting_price">Starting Price<span class="required">*</span></label>
            <input placeholder="Enter the starting price"
                   id="item-starting_price"
                   required
                   name="starting_price" 
                   spellcheck="false"
                   class="form-control"
               />
           </div>

           <div class="form-group">
            <label for="item-max_price">Maximum Price<span class="required">*</span></label>
            <input placeholder="Enter the maximum price"
                   id="item-max_price"
                   required
                   name="max_price" 
                   spellcheck="false"
                   class="form-control"
               />
           </div>

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
 </form>
    </div>
  </div>
</div>
  @endsection