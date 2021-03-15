@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class=" col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
                        <users-component>

                        </users-component>
                        <a class="btn btn-secondary" href="{{route('users.edit',Auth::user()->id)}}">Edit profile</a>
                        <a class="btn btn-danger" onclick="
          var result = confirm('Are you sure you want to deactivate your profile?');
          if(result){
            event.preventDefault();
            document.getElementById('delete-form').submit();
          }
        " href="#" >Delete</a>
        <form id="delete-form" 
        action="{{route('users.destroy',[Auth::user()->id])}}"
        method="POST"
        style="display: none"
        >
    <input type="hidden" name="_method" value="delete">
    {{ csrf_field() }}
   
  </form>
                    </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
