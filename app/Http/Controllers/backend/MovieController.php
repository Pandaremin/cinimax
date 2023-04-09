<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Genre;
use App\Models\User;
use App\Models\Content;
use App\Models\MovieLink;
use DB;
class MovieController extends Controller
{
    
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $data = Content::paginate(10);
        return view('backend.movie.index',compact(['user','data']));
    }

    
    public function create()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $genre = Genre::all();
        return view('backend.movie.create',compact(['user','genre']));
    }

    
    public function store(Request $request)
    {
        DB::transaction(function() use($request){

            $validatedData = $request->validate([
                'title' => 'required',
            ]);

            $movieadd               = new Content();
            $movieadd->title        = $request->title;
            $movieadd->cover        = $request->cover;
            $movieadd->poster       = $request->cover;
            $movieadd->overview     = $request->overview;
            $movieadd->rating       = $request->rating;
            $movieadd->release_date = $request->release_date;
            $movieadd->duration     = $request->duration;
            $movieadd->view         = 0;
            $movieadd->trailer      = $request->trailer;
            $movieadd->publish      = $request->has('publish');
            $movieadd->featured     = $request->has('featured');
            $movieadd->premium_only = $request->has('premium_only');
            $movieadd->content_type = $request->content_type;
            $movieadd->user_id      = Auth::user()->id;
            $movieadd->save();

            foreach ($request->genre as $genres) { 
                $movieadd->genres()->attach($genres);
            }

            $last = Content::latest()->first();
            $countMovie = count($request->link);
            
            if ($countMovie !=NULL) {
                for ($i=0; $i <$countMovie ; $i++) { 
                    $movielink = new MovieLink();
                    $movielink->linktitle = $request->linktitle[$i];
                    $movielink->type = $request->type[$i];
                    $movielink->link = $request->link[$i];
                    $last->movielinks()->save($movielink);
                } // End For Loop
            }//
        });
        $notification = array(
            'message' => 'Movie created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('movie.index')->with($notification);
    }

    public function edit($id)
    {
        $idd = Auth::user()->id;
        $user = User::find($idd);
        $data=Content::with(['genres','movielinks'])->find($id);
        $genre = Genre::all();
        return view('backend.movie.edit',compact(['data','user','genre']));
    }

   
    public function update(Request $request, $id)
    {
        DB::transaction(function() use($request,$id){

            $idd = Auth::user()->id;
            $user = User::find($idd);

            $validatedData = $request->validate([
                'title' => 'required',
            ]);

            $movieupdate=Content::find($id); 
            $movieupdate->title = $request->title;
            $movieupdate->cover = $request->cover;
            $movieupdate->poster = $request->cover;
            $movieupdate->overview = $request->overview;
            $movieupdate->rating = $request->rating;
            $movieupdate->release_date = $request->release_date;
            $movieupdate->duration = $request->duration;
            $movieupdate->view = 100;
            $movieupdate->trailer = $request->trailer;
            $movieupdate->publish = $request->has('publish');
            $movieupdate->featured = $request->has('featured');
            $movieupdate->premium_only = $request->has('premium_only');
            $movieupdate->content_type = $request->content_type;

            $movieupdate->save();
            $movieupdate->genres()->sync($request->genre);

            $countMovie = count($request->linktitle);
            MovieLink::where('content_id',$id)->delete();
            if ($countMovie !=NULL) {
                for ($i=0; $i <$countMovie ; $i++) { 
                    $movielink = new  MovieLink();
                    $movielink->linktitle = $request->linktitle[$i];
                    $movielink->type = $request->type[$i];
                    $movielink->link = $request->link[$i];
                    $movielink->content_id = $id;
                    $movielink->save();
                } // End For Loop
            }//
        });
        
        $notification = array(
            'message' => 'Movie edited successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('movie.index')->with($notification);
    }

   
    public function destroy($id)
    {
        $movie=Content::find($id);
        $movie->genres()->detach();
        $movie->delete();
        return redirect()->route('movie.index')->with('success','Movie deleted successfully');
    }

    public function search(Request $request){
        $idd = Auth::user()->id;
        $user = User::find($idd);
        $search = $request->input('title');
    
        $data = Content::query()->where('title', 'LIKE', "%{$search}%")->with('user')->get();
    
        // Return the search view with the resluts compacted
        return view('backend.movie.search', compact(['data','user']));
    }
}
