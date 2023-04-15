@extends('backend.layout')
@section('main')
<div class="pagetitle">
    <h1>Streaming Service</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Streaming Service</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<div class="card">
    <div class="card-body">
        <form class="row g-3" method="post" action="{{route('streamingservice.update',$streamingservice->id)}}">
            @csrf
            @method('PUT')
            <div class="col-12 mt-4">
                <label for="title" class="form-label mt-2 mb-1 ms-2">Title</label>
                <input type="text" class="form-control p-4" id="title" name="title" value="{{$streamingservice->title}}" >
                @error('title')
                    <p class="text-danger px-2 mb-0">{{$message}}</p>
                @enderror
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection