@extends('backend.layout')
@section('main')
<div class="pagetitle">
      <h1>Movies</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Search</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
@if($data->isNotEmpty())
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
        Uploaded By
        </div>
    </div>
</div>
@foreach($data as $movie)
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
            <div class="col-2 d-flex justify-content-around align-items-center">
            <a href="{{ route('movie.edit',$movie->id) }}"><i class="fa-solid fa-pen-to-square me-3"></i></a>
            <a href="{{ route('movie.delete',$movie->id) }}"><i class="fa-solid fa-trash me-4"></i></a>
            </div>
        </div>
    </div>
    
@endforeach
@else 
    <div class="d-flex justify-content-center">
        <h5 style="color:grey;">No item match your search</h5>
    </div>
@endif

@endsection