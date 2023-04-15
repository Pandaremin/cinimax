@extends('backend.layout')
@section('main')
<div class="pagetitle">
    <h1>Genre</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Movie</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<form action="" method="get">
    <div class="genre-add-search mt-4">
        <a href="{{ route('movie.create') }}"><button type="button" class="btn btn-add" ><i class="fa-solid fa-plus me-1"></i></button></a>
        <input type="text" class="form-control genre-input" name="search" placeholder="Search..." value="{{request('search')}}">
   </div>
</form>
<div class="card-headingg">
    <div class="row">
        <div class="col-1 text-center">
            ID
        </div>
        <div class="col-2">
            Poster
        </div>
        <div class="col-5">
            Title
        </div>
        <div class="col-2">
            Uploaded by
        </div>
    </div>
</div>
@foreach($movies as $movie)
<form action="{{ route('movie.destroy',$movie->slug) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="card-bodyy">
        <div class="row">
            <div class="col-1 text-center d-flex justify-content-center align-items-center">
                {{$movie->id}}
            </div>
            <div class="col-2 d-flex align-items-center" style="font-weight:600;">
                
                    <img src="{{$movie->cover}}" alt="No photo" style="width:55px;height:80px; border-radius:5px;">
                
            </div>
            <div class="col-5 d-flex align-items-center" style="font-weight:600;">
                {{$movie->title}}
            </div>
            <div class="col-2 d-flex align-items-center" style="font-weight:600;">
                {{$movie->user->name}}
            </div>
            <div class="col-1 d-flex justify-content-center align-items-center">
            @canany(['update','isAdmin'],$movie)
            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis-vertical" style="width:40px;height:40px;display:flex;justify-content:center;align-items:center;"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="text-center"><a href="{{ route('movie.edit',$movie->slug) }}">Edit</a></li>
                <li class="d-flex justify-content-center"><button type="submit" class="btn btncolor text-danger"><b>Delete</b></button></li>
              </ul>
            </div>
            @endcan
            </div>
        </div>
    </div>
</form>
@endforeach

@endsection