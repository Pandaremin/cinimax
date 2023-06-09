@extends('backend.layout')
@section('main')
<div class="pagetitle">
    <h1>Genre</h1>
    <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Search</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

@if($genre->isNotEmpty())
<div class="card-headingg">
    <div class="row">
        <div class="col-1 text-center">
        Id
        </div>
        <div class="col-9">
        Title
        </div>
    </div>
</div>
@foreach($genre as $genre)
    <div class="card-bodyy">
        <div class="row">
            <div class="col-1 text-center">
                {{$genre->id}}
            </div>
            <div class="col-9" style="font-weight:600;">
                {{$genre->title}}
            </div>
            <div class="col-2 d-flex justify-content-around align-items-center">
            <a href="{{ route('genre.edit',$genre->id) }}"><i class="fa-solid fa-pen-to-square me-3"></i></a>
            <a href="{{ route('genre.delete',$genre->id) }}"><i class="fa-solid fa-trash me-4"></i></a>
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