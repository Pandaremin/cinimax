<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\Content;
use App\Models\MovieLink;
use DB;

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


    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $validatedData = $request->validate([
                'title' => 'required',
                'cover' => 'required',
                'overview' => 'required',
                'rating' => 'required',
                'release_date' => 'required',
                'duration' => 'required',
                'trailer' => 'required',
                'genre' => 'required',
            ]);

            $movieadd               = new Content();
            $movieadd->title        = $request->title;
            $movieadd->cover        = $request->cover;
            $movieadd->poster       = $request->cover;
            $movieadd->overview     = $request->overview;
            $movieadd->rating       = $request->rating;
            $movieadd->release_date = $request->release_date;
            $movieadd->duration     = $request->duration;
            $movieadd->trailer      = $request->trailer;
            $movieadd->publish      = $request->has('publish');
            $movieadd->featured     = $request->has('featured');
            $movieadd->premium_only = $request->has('premium_only');
            $movieadd->content_type = $request->content_type;
            auth()->user()->contents()->save($movieadd);

            $movieadd->genres()->attach($request->genre);

            $lastmovie = Content::latest()->first();
            $countLink = count($request->link);

            if ($countLink !=null) {
                for ($i=0; $i <$countLink ; $i++) {
                    $movielink = new MovieLink();
                    $movielink->linktitle = $request->linktitle[$i];
                    $movielink->type = $request->type[$i];
                    $movielink->link = $request->link[$i];
                    $lastmovie->movielinks()->save($movielink);
                } // End For Loop
            }//
        });
        $notification = [
            'message' => 'Movie created successfully',
            'alert-type' => 'success'
        ];
        return to_route('movie.index')->with($notification);
    }

    public function edit($id)
    {
        $data=Content::with(['genres','movielinks'])->find($id);
        abort_if(Gate::none(['update','isAdmin'], $data), 403);
        $genre = Genre::all();
        return view('backend.movie.edit', compact(['data','genre']));
    }


    public function update(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $validatedData = $request->validate([
                    'title' => 'required',
                    'cover' => 'required',
                    'overview' => 'required',
                    'rating' => 'required',
                    'release_date' => 'required',
                    'duration' => 'required',
                    'trailer' => 'required',
                ]);

            $movieupdate=Content::find($id);
            abort_if(Gate::none(['update','isAdmin'], $movieupdate), 403);
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
