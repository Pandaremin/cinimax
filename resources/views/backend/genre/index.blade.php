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

<form action="" method="get">
    <div class="genre-add-search mt-4">
        @can('isAdmin')
        <a href="{{ route('genre.create') }}"><button type="button" class="btn btn-add" ><i class="fa-solid fa-plus me-1"></i></button></a>
        @endcan
        <input type="text" class="form-control genre-input" name="search" placeholder="Search..." value="{{request('search')}}">
    </div>
</form>

@if($genres->isNotEmpty())
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

@foreach($genres as $genre)
    <form action="{{ route('genre.destroy',$genre->id) }}" method="post">
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
                @can('isAdmin')
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <a href="{{ route('genre.edit',$genre->id) }}"><i class="fa-solid fa-pen-to-square me-3"></i></a>
                    <button type="submit" class="btn btncolor text-danger"><i class="fa-solid fa-trash me-4"></i></button>
                </div>
                @endcan
            </div>
        </div>
    </form>
    
@endforeach
@else 
    <div>
        <h4>No genre found</h4>
    </div>
@endif
<div class="d-flex justify-content-center">{{ $genres->links() }}</div>
@endsection