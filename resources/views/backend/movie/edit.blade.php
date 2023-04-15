@extends('backend.layout')
@section('main')
<div class="pagetitle">
      
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Movies</li>
          <li class="breadcrumb-item active">Add</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <form method="post" action="{{route('movie.update',$data->slug)}}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-9">
            <!-- Pills Tabs -->
            <ul class="nav nav-pills mb-3 justify-content-center " id="pills-tab" role="tablist">
                <li class="nav-item mx-2" role="presentation">
                <button class="nav-link active rounded-pill" id="pills-general-tab" data-bs-toggle="pill" data-bs-target="#pills-general" type="button" role="tab" aria-controls="pills-general" aria-selected="true">General</button>
                </li>
                <li class="nav-item mx-2 " role="presentation">
                <button class="nav-link rounded-pill" id="pills-video-tab" data-bs-toggle="pill" data-bs-target="#pills-video" type="button" role="tab" aria-controls="pills-video" aria-selected="false">Video</button>
                </li>
            </ul>
            <div class="tab-content pt-2" id="myTabContent">
                <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="general-tab">
                    <!-- Multi Columns Form -->
                    <div class="row">
                        <div class="col-md-12">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Movie title" value="{{$data->title}}">
                            @error('title')
                                <p class="text-danger px-2 mb-0">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="cover" class="form-label">Cover</label>
                            <input type="text" class="form-control" id="cover" name="cover" placeholder="Poster link" value="{{$data->cover}}">
                            @error('cover')
                                <p class="text-danger px-2 mb-0">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="genre" class="form-label">Genres</label>
                            <div class="d-flex align-items-center" style="border-radius:5px;border:1px solid #ced4da;">
                                <select class="form-select" data-placeholder="Choose genre" id="genre" name="genre[]" multiple>
                                    @foreach($genre as $genre)
                                    <option value="{{$genre->id}}" @foreach($data->genres as $genres) @if($genres->id === $genre->id)selected="selected" @endif @endforeach }}>{{$genre->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('genre')
                                <p class="text-danger px-2 mb-0">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="overview" class="form-label">Overview</label>
                            <textarea class="form-control" placeholder="Overview" id="overview" name="overview" placeholder="Movie overview" style="height: 100px;">{{$data->overview}}</textarea>
                            @error('overview')
                                <p class="text-danger px-2 mb-0">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" class="form-control" id="rating" name="rating" placeholder="Rating" value="{{$data->rating}}">
                            @error('rating')
                                <p class="text-danger px-2 mb-0">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="text" class="form-control" id="release_date" name="release_date" placeholder="Release date" value="{{$data->release_date}}">
                            @error('release_date')
                                <p class="text-danger px-2 mb-0">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration" value="{{$data->duration}}">
                            @error('duration')
                                <p class="text-danger px-2 mb-0">{{$message}}</p>
                            @enderror
                            </div>
                        <div class="col-12">
                            <label for="trailer" class="form-label">Trailer</label>
                            <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Trailer link" value="{{$data->trailer}}">
                            @error('trailer')
                                <p class="text-danger px-2 mb-0">{{$message}}</p>
                            @enderror
                        </div>
                    </div>    
                </div>
                <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="video-tab">
                    <div class="add_item">
                        @foreach($data->movielinks as $links)
                        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-bodyy">
                                        <div class="row g-3 d-flex align-items-center">
                                            <div class="col-12 col-md-4 text-center">
                                                <select id="inputState" title="Select server" name="linktitle[]" class="form-select">
                                                    <option {{$links->linktitle === "StreamSB" ? "selected" : ""}}>StreamSB</option>
                                                    <option {{$links->linktitle === "StreamTape" ? "selected" : ""}}>StreamTape</option>
                                                    <option {{$links->linktitle === "Google drive" ? "selected" : ""}}>Google drive</option>
                                                    <option {{$links->linktitle === "StreamHide" ? "selected" : ""}}>StreamHide</option>
                                                    <option {{$links->linktitle === "FEmbed" ? "selected" : ""}}>FEmbed</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-3" style="font-weight:600;">
                                                <select id="inputState" title="Select type" name="type[]" class="form-select">
                                                    <option {{$links->type === "Free" ? "selected" : ""}}>Free</option>
                                                    <option {{$links->type === "StreamSB" ? "Premium" : ""}}>Premium</option>
                                                    <option {{$links->type === "Download" ? "selected" : ""}}>Download</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-4 text-center">
                                                <input type="text" class="form-control" value="{{$links->link}}" name="link[]" placeholder="Link">
                                                <input type="hidden" name="linkid[]" value="{{$links->id}}">
                                            </div>
                                            <div class="col-12 col-md-1 d-flex justify-content-center align-items-center">
                                                <span class="btn btncolor addeventmore" style="font-size:21px;"><i class="fa-solid fa-circle-plus"></i></span>
                                                <span class="btn btncolor text-danger removeeventmore" style="font-size:21px;"><i class="fa-solid fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div><!-- End Pills Tabs -->
        </div>
        <div class="col-md-3 mt-3">
            <p class="text-start mb-1">Advanced</p>
            <div class="form-switch">
                <input type="hidden" name="publish" value="0">
                <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1"  {{$data->publish === 1 ? "checked" : ""}}>
                <label class="form-check-label" for="publish">Publish</label>
            </div>
            <div class="form-switch">
                <input type="hidden" name="featured" value="0">
                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" {{$data->featured === 1 ? "checked" : ""}}>
                <label class="form-check-label" for="featured">Featured</label>
            </div>
            <div class="form-switch">
                <input type="hidden" name="premium_only" value="0">
                <input class="form-check-input" type="checkbox" id="premium-only" name="premium_only" value="1" {{$data->premium_only === 1 ? "checked" : ""}}>
                <label class="form-check-label" for="premium-only">Premium</label>
            </div>
            <input type="hidden" class="form-control" id="content_type" name="content_type" value="movie">
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-3 w-100">Submit</button>
            </div>
        </div>
    </div>
    
    </form><!-- End Multi Columns Form -->

<div style="visibility:hidden;">
    <div class="whole_extra_item_add" id="whole_extra_item_add">
        <div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
            <div class="row">
                <div class="col-12">
                    
                        <div class="card-bodyy">
                            <div class="row g-3 d-flex align-items-center">
                                <div class="col-12 col-md-4 text-center">
                                    <select id="inputState" title="Select server" name="linktitle[]" class="form-select">
                                        <option>StreamSB</option>
                                        <option>StreamTape</option>
                                        <option>Google drive</option>
                                        <option>StreamHide</option>
                                        <option>FEmbed</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-3">
                                    <select id="inputState" title="Select type" name="type[]" class="form-select">
                                        <option>Free</option>
                                        <option>Premium</option>
                                        <option>Download</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-4 text-center">
                                    <input type="text" class="form-control" name="link[]" placeholder="Link">
                                    <input type="hidden" name="linkid[]" value="{{$links->id}}">
                                </div>
                                <div class="col-12 col-md-1 d-flex justify-content-center align-items-center">
                                    <span class="btn btncolor text-danger removeeventmore" style="font-size:21px;"><i class="fa-solid fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
 	$(document).ready(function(){
 		var counter = 0;
 		$(document).on("click",".addeventmore",function(){
 			var whole_extra_item_add = $('#whole_extra_item_add').html();
 			$(this).closest(".add_item").append(whole_extra_item_add);
 			counter++;
 		});
 		$(document).on("click",'.removeeventmore',function(event){
 			$(this).closest(".delete_whole_extra_item_add").remove();
 			counter -= 1
 		});

 	});
 </script>
 <script>
    $( '#genre' ).select2( {
    theme: "bootstrap-5",
    // width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    closeOnSelect: false,
    } );
 </script>
@endpush
@endsection