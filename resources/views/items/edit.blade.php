@extends('layouts.app')
@section('content')



      <h3 class="panel-title">Edit Product</h3>
    <br/>
    
    
      
        <form method="POST" action="{{route('items.update',[$item->id])}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            <div class="form-group">
                <label for="name">Name<span class="required">*</span></label>
                <input placeholder="Enter the name"
                       id="name"
                       required
                       name="name" 
                       spellcheck="false"
                       class="form-control"
                       value="{{$item->name}}"
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
                      value="{{$item->description}}"
                      >
                      
            </textarea>
           </div>
           <div class="form-group">
            <label for="name">Image</label>
            <input placeholder="Image path"
                   id="image"
                   required
                   name="image" 
                   spellcheck="false"
                   class="form-control"
                   value="{{$item->image}}"
               />
        </div>
           <div class="form-group">
            <label for="item-starting_price">Starting Price<span class="required">*</span></label>
            <input placeholder="Enter the starting price"
                   id="item-starting_price"
                   required
                   name="starting_price" 
                   spellcheck="false"
                   class="form-control"
                   value="{{$item->starting_price}}"
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
                   value="{{$item->max_price}}"
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
            <label for="payment-content">Select payment method</label>
            <select name="payment_id" class="form-group">
                @foreach ($payments as $payment)
                <option value="{{$payment->id}}">{{$payment->name}}</option>
                @endforeach
            </select>
            </div>

            <div class="form-group">
                <label for="shipper-content">Select shipper</label>
                <select name="shipper_id" class="form-group">
                    @foreach ($shippers as $shipper)
                    <option value="{{$shipper->id}}">{{$shipper->company_name}}</option>
                    @endforeach
                </select>
                </div>

           <div class="form-group">
               <input type="submit" class="btn btn-primary" value="Update"/>
           </div>
 </form>
   
  @endsection