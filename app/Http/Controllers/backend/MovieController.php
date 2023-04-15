<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Content;
use App\Models\MovieLink;
use App\Models\StreamingService;
use DB;
use App\Http\Requests\ContentRequest;
use Alert;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Content::with('user')->where('content_type', 'movie')->latest();
        if($request->search) {
            $movies->where('title', 'LIKE', "%{$request->search}%")->with('user');
        }
        return view('backend.movie.index', ['movies' => $movies->get()]);
    }

    public function create()
    {
        $genre = Genre::all();
        $streamingServices = StreamingService::all();
        return view('backend.movie.create', compact(['streamingServices','genre']));
    }

    public function store(ContentRequest $request)
    {
        // Movie add
        $validated = $request->safe()->except(['genre', 'linktitle','type','link']);
        $movie = new Content($validated);
        auth()->user()->contents()->save($movie);

        // Link Movie and genre
        $movie->genres()->attach($request->genre);

        // Add link to movie
        $this->addLinks($request,$movie);

        Alert::toast('Movie created successfully');
        return to_route('movie.index');
    }

    public function edit(Content $movie)
    {
        abort_if(Gate::none(['update','isAdmin'], $movie),403);

        $data=Content::with(['genres','movielinks'])->find($movie->id);
        $genre = Genre::all();
        $streamingServices = StreamingService::all();
        return view('backend.movie.edit', compact(['streamingServices','data','genre']));
    }


    public function update(ContentRequest $request,Content $movie)
    {
        abort_if(Gate::none(['update','isAdmin'], $movie),403);

        $validatedData = $request->safe()->except(['genre', 'linktitle','type','link']);
        $movie->slug = null;
        $movie->update($validatedData);
        auth()->user()->contents()->save($movie);

        $movie->genres()->sync($request->genre);
        $this->addLinks($request,$movie);
        
        Alert::toast('Movie updated successfully');
        return to_route('movie.index');
    }

    public function destroy(Content $movie)
    {
        abort_if(Gate::none(['update','isAdmin'], $movie),403);
        
        $movie->genres()->detach();
        $movie->delete();
        Alert::toast('Movie deleted successfully');
        return back();
    }

    public function addLinks($request,$movie)
    {
        $currentmovie = Content::latest()->first();
        $countLink = count($request->linktitle);
        MovieLink::where('content_id', $movie->id)->delete();
        if ($countLink !=null) {
            for ($i=0; $i <$countLink ; $i++) {
                $movielink = new  MovieLink();
                $movielink->linktitle = $request->linktitle[$i];
                $movielink->type = $request->type[$i];
                $movielink->link = $request->link[$i];
                $currentmovie->movielinks()->save($movielink);
            }
        }
    }
}
