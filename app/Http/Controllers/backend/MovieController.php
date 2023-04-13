<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Content;
use App\Models\MovieLink;
use DB;
use App\Http\Requests\ContentRequest;


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
        return view('backend.movie.create', compact('genre'));
    }

    public function store(ContentRequest $request)
    {
        // Movie add
        $validated = $request->safe()->except(['genre', 'linktitle','type','link']);
        $movieadd = new Content($validated);
        auth()->user()->contents()->save($movieadd);
        // Link Movie and genre
        $movieadd->genres()->attach($request->genre);
        // Add link to movie
        $currentmovie = Content::latest()->first();
        $countLink = count($request->link);
        for ($i=0; $i <$countLink ; $i++) {
            $movielink = new MovieLink();
            $movielink->linktitle = $request->linktitle[$i];
            $movielink->type = $request->type[$i];
            $movielink->link = $request->link[$i];
            $currentmovie->movielinks()->save($movielink);
        } // End For Loop
        Alert::toast('Movie created successfully');
        return to_route('movie.index');
    }

    public function edit($id)
    {
        $data=Content::with(['genres','movielinks'])->find($id);
        abort_if(Gate::none(['update','isAdmin'], $data), 403);
        $genre = Genre::all();
        return view('backend.movie.edit', compact(['data','genre']));
    }


    public function update(Request $request,Content $content)
    {
        DB::transaction(function () use ($request, $id) {
            $validatedData = $request->safe()->except(['genre', 'linktitle','type','link']);
            abort_if(Gate::none(['update','isAdmin'], $content), 403);
            $movieupdate->title = $request->title;
            $movieupdate->cover = $request->cover;
            $movieupdate->poster = $request->cover;
            $movieupdate->overview = $request->overview;
            $movieupdate->rating = $request->rating;
            $movieupdate->release_date = $request->release_date;
            $movieupdate->duration = $request->duration;
            $movieupdate->trailer = $request->trailer;
            $movieupdate->publish = $request->has('publish');
            $movieupdate->featured = $request->has('featured');
            $movieupdate->premium_only = $request->has('premium_only');
            $movieupdate->content_type = $request->content_type;
            auth()->user()->contents()->save($movieupdate);

            $movieupdate->genres()->sync($request->genre);

            $countLink = count($request->linktitle);
            MovieLink::where('content_id', $id)->delete();
            if ($countLink !=null) {
                for ($i=0; $i <$countLink ; $i++) {
                    $movielink = new  MovieLink();
                    $movielink->linktitle = $request->linktitle[$i];
                    $movielink->type = $request->type[$i];
                    $movielink->link = $request->link[$i];
                    $movielink->content_id = $id;
                    $movielink->save();
                } // End For Loop
            }//
        });

        $notification = [
            'message' => 'Movie edited successfully',
            'alert-type' => 'success'
        ];
        return to_route('movie.index')->with($notification);
    }

    public function destroy($id)
    {
        $movie=Content::find($id);
        abort_if(Gate::none(['delete','isAdmin'], $data), 403);
        $movie->genres()->detach();
        $movie->delete();
        $notification = [
            'message' => 'Movie deleted successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }
}
