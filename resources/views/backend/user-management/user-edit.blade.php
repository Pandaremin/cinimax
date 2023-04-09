@extends('backend.layout')
@section('title','User Edit')
@section('main')

<div class="pagetitle">
    <h1>User Edit</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Home</a></li>
        <li class="breadcrumb-item active">User-Edit</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
            <div class="card-body pt-3">
              
            <h5 class="card-title">Profile Details</h5>

                <div class="row">
                <div class="col-xs-4 col-md-4 col-lg-3  label ">Full Name</div>
                <div class="col-xs-8 col-md-8 col-lg-9 ">{{$data->name}}</div>
                </div>

                <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8">{{$data->email}}</div>
                </div>

                <div class="row">
                <div class="col-lg-3 col-md-4 label">User type</div>
                <div class="col-lg-9 col-md-8">{{$data->role}}</div>
                </div>
                <form method="post" action="{{ route('user.update',$data->id) }}">
                @csrf
                    <label for="role" class="col-4 col-form-label">Role</label>
                    <div class="col-4">
                    <select name="role" id="role" class="form-select">
                      <option value="free_user">Free user</option>
                      <option value="premium_user">Premium user</option>
                      <option value="admin">Admin</option>
                      <option value="content_manager">Content Manager</option>
                    </select>
                        @error('role')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Change Role</button>
                    </div>
                </form><!-- End Profile Edit Form -->

            </div>
          </div>

@endsection