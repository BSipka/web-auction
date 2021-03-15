@extends('layouts.app')
@section('content')
<div class=" col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
<div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title">Add Product</h3>
    <br/>
    </div>
    <div class="panel-body">
        <form method="POST" action="{{route('users.update',[$user->id])}}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            <div class="form-group">
                <label for="user-name">Name</label>
                <input placeholder="Enter the name"
                       id="user-name"
                       required
                       name="name" 
                       spellcheck="false"
                       class="form-control"
                       value="{{$user->name}}"
                   />
            </div>
            <div class="form-group">
                <label for="user-email">Email</label>
                <input placeholder="Enter the email"
                       id="user-email"
                       required
                       name="email" 
                       spellcheck="false"
                       class="form-control"
                       value="{{$user->email}}"
                   />
            </div>
            <div class="form-group">
                <label for="user-firstname">First name</label>
                <input placeholder="Enter the first name"
                       id="user-firstname"
                       required
                       name="first_name" 
                       spellcheck="false"
                       class="form-control"
                       value="{{$user->first_name}}"
                   />
            </div>
            <div class="form-group">
                <label for="user-middlename">Middle name</label>
                <input placeholder="Enter the middle name"
                       id="user-middlename"
                       required
                       name="middle_name" 
                       spellcheck="false"
                       class="form-control"
                       value="{{$user->middle_name}}"
                   />
            </div>
            <div class="form-group">
                <label for="user-lastname">Last name</label>
                <input placeholder="Enter the last name"
                       id="user-lastname"
                       required
                       name="last_name" 
                       spellcheck="false"
                       class="form-control"
                       value="{{$user->last_name}}"
                   />
            </div>
            <div class="form-group">
                <label for="user-city">City</label>
                <input placeholder="Enter your city"
                       id="user-city"
                       required
                       name="city" 
                       spellcheck="false"
                       class="form-control"
                       value="{{$user->city}}"
                   />
            </div>
           <div class="form-group">
               <input type="submit" class="btn btn-primary" value="Submit"/>
           </div>
 </form>
    </div>
  </div>
</div>
  @endsection