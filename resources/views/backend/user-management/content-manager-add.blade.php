@extends('backend.layout')
@section('title','Add Content Manager')
@section('main')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Add Content Manager</h4>
        <form  method="post" action="{{route('content.manager.store')}}" class="row g-3">
        @csrf
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Name</label>
                  <input id="name" class="form-control block mt-1 w-full" type="text" name="name" required autofocus>
                </div>
                <div class="col-md-6">
                  <label for="inputEmail5" class="form-label">Email</label>
                  <input id="email" class="form-control block mt-1 w-full" type="email" name="email" required >
                </div>
                <div class="col-md-6">
                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password</label>
                      
                      <input id="password" class="form-control block mt-1 w-full" type="password" name="password" required >
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <div class="col-md-6">
                <label for="renewPassword" class="form-label">Confirm Password</label>
                      <input id="password_confirmation" class="form-control block mt-1 w-full" type="password" name="password_confirmation" required >
                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <input type="hidden" id="role" name="role" value="writer">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
        </form><!-- End Multi Columns Form -->

    </div>
</div>



@endsection