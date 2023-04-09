@extends('backend.layout')
@section('main')
<div class="pagetitle">
      <h1>Genre</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Genre</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
<form action="{{ route('genre.search') }}" method="get">
    <div class="genre-add-search mt-4">
        <a href="{{ route('genre.create') }}"><button type="button" class="btn btn-add" ><i class="fa-solid fa-plus me-1"></i></button></a>
        <input type="text" class="form-control genre-input" name="title" placeholder="Search...">
   </div>
</form>
<div class="card-headingg">
    <div class="row">
        <div class="col-1 text-center">
        ID
        </div>
        <div class="col-9">
        Title
        </div>
    </div>
</div>
@foreach($genre as $genre)
<form action="{{ route('genre.delete',$genre->id) }}" method="post">
    @csrf
    @method('DELETE')
    <div class="card-bodyy">
        <div class="row">
            <div class="col-1 text-center">
                {{$genre->id}}
            </div>
            <div class="col-9" style="font-weight:600;">
                {{$genre->title}}
            </div>
            
            <div class="col-2 d-flex justify-content-center align-items-center">
            <a href="{{ route('genre.edit',$genre->id) }}"><i class="fa-solid fa-pen-to-square me-3"></i></a>
            <a href="{{ route('genre.delete',$genre->id) }}"></i></a>
            <button type="submit" class="btn btncolor text-danger"><i class="fa-solid fa-trash me-4"></i></button>
            </div>
        </div>
    </div>
</form>
    
@endforeach

@endsection