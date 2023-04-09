@extends('backend.layout')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="pagetitle">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Movies</li>
            <li class="breadcrumb-item active">Add</li>
        </ol>
    </nav>
</div><!-- End Page Title -->

<form method="post" action="{{route('movie.store')}}">
    @csrf
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
                            <input type="text" class="form-control" id="title" name="title" placeholder="Movie title">
                        </div>
                        <div class="col-md-12">
                            <label for="cover" class="form-label">Cover</label>
                            <input type="text" class="form-control" id="cover" name="cover" placeholder="Poster link">
                        </div>
                        <div class="col-md-12">
                            <label for="genre" class="form-label">Genres</label>
                            <select class="selectpicker form-control" style="background: #5cb85c; color: #fff;" id="genre" name="genre[]" multiple title="Choose one of the following...">
                                @foreach($genre as $genre)
                                <option value="{{$genre->id}}">{{$genre->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="overview" class="form-label">Overview</label>
                            <textarea class="form-control" placeholder="Overview" id="overview" name="overview" placeholder="Movie overview" style="height: 100px;"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" class="form-control" id="rating" name="rating" placeholder="Rating">
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <label for="release_date" class="form-label">Release Date</label>
                            <input type="text" class="form-control" id="release_date" name="release_date" placeholder="Release date">
                        </div>
                        <div class="col-md-4">
                            <label for="duration" class="form-label">Duration</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Duration">
                        </div>
                        <div class="col-12">
                            <label for="trailer" class="form-label">Trailer</label>
                            <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Trailer link">
                        </div>
                    </div>    
                </div>
                <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="video-tab">
                    <div class="add_item">
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
                                        <div class="col-12 col-md-3" style="font-weight:600;">
                                            <select id="inputState" title="Select type" name="type[]" class="form-select">
                                                <option>Free</option>
                                                <option>Premium</option>
                                                <option>Download</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4 text-center">
                                            <input type="text" class="form-control" name="link[]" placeholder="Link">
                                        </div>
                                        <div class="col-12 col-md-1 d-flex justify-content-center align-items-center">
                                            <span class="btn btncolor text-danger addeventmore" style="font-size:24px;"><i class="fa-solid fa-circle-plus"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- End Pills Tabs -->
        </div>
        <div class="col-md-3 mt-3">
            <p class="text-start mb-1">Advanced</p>
            <div class="form-switch">
                <input class="form-check-input" type="checkbox" id="publish" name="publish" value="1" checked>
                <label class="form-check-label" for="publish">Publish</label>
            </div>
            <div class="form-switch">
                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1">
                <label class="form-check-label" for="featured">Featured</label>
            </div>
            <div class="form-switch">
                <input class="form-check-input" type="checkbox" id="premium-only" name="premium_only" value="1">
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
                                </div>
                                <div class="col-12 col-md-1 d-flex justify-content-center align-items-center">
                                    <span class="btn btncolor text-danger removeeventmore" style="font-size:24px;"><i class="fa-solid fa-trash"></i></span>
                                </div>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

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
@endsection