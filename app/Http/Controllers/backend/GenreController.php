<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Genre;
use App\Models\User;

class GenreController extends Controller
{
    
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $genre = Genre::all();
        return view('backend.genre.index',compact(['user','genre']));
    }

    
    public function create()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.genre.create',compact('user'));
    }

    
    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $genreadd = new Genre();
    	$genreadd->title = $request->title;
        $genreadd->save();
        $genre = Genre::all();
        $notification = array(
            'message' => 'Genre created successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('genre.index')->with($notification);
        
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $idd = Auth::user()->id;
        $user = User::find($idd);
        $data=Genre::find($id);
        
        return view('backend.genre.edit',compact(['data','user']));
    }

    
    public function update(Request $request, $id)
    {
        $idd = Auth::user()->id;
        $user = User::find($idd);

        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $data=Genre::find($id);
        $data->title=$request->title;
        $data->save();
        $genre = Genre::all();
        
        $notification = array(
            'message' => 'Genre edited successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('genre.index')->with($notification);
    }

    public function destroy($id)
    {
        $data=Genre::find($id)->delete();
        return redirect()->route('genre.index')->with('success','Genre deleted successfully');
    }

    public function search(Request $request){
        $idd = Auth::user()->id;
        $user = User::find($idd);
        $search = $request->input('title');
    
        $data = Genre::query()->where('title', 'LIKE', "%{$search}%")->get();
    
        // Return the search view with the resluts compacted
        return view('backend.genre.search', compact(['data','user']));
    }
}
