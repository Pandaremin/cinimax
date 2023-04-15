@extends('backend.layout')
@section('main')
<div class="pagetitle">
    <h1>Streaming Services</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Streaming Services</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<form action="" method="get">
    <div class="genre-add-search mt-4">
        <a href="{{ route('streamingservice.create') }}"><button type="button" class="btn btn-add" ><i class="fa-solid fa-plus me-1"></i></button></a>
        <input type="text" class="form-control genre-input" name="search" placeholder="Search..." value="{{request('search')}}">
    </div>
</form>

@forelse($streamingServices as $streamingService)
    <form action="{{ route('streamingservice.destroy',$streamingService->id) }}" method="post">
    @csrf
    @method('DELETE')
        <div class="card-bodyy">
            <div class="row">
                <div class="col-1 text-center">
                    {{$streamingService->id}}
                </div>
                <div class="col-9" style="font-weight:600;">
                    {{$streamingService->title}}
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">
                    <a href="{{ route('streamingservice.edit',$streamingService->id) }}"><i class="fa-solid fa-pen-to-square me-3"></i></a>
                    <button type="submit" class="btn btncolor text-danger"><i class="fa-solid fa-trash me-4"></i></button>
                </div>
            </div>
        </div>
    </form>
    
@empty 
    <div>
        <h4>No Server found</h4>
    </div>
@endforelse
@endsection