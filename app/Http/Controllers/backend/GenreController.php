<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Support\Facades\Gate;


class GenreController extends Controller
{
    
    public function index()
    {
        $genre = Genre::all();
        return view('backend.genre.index',compact('genre'));
    }

    
    public function create()
    {
        abort_if(Gate::denies('isAdmin'), 403);
        return view('backend.genre.create');
    }

    
    public function store(Request $request)
    {
        abort_if(Gate::denies('isAdmin'), 403);
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $genreadd = new Genre();
    	$genreadd->title = $request->title;
        $genreadd->save();
        $notification = [
            'message' => 'Genre created successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('genre.index')->with($notification);
        
    }
    
    public function edit($id)
    {
        abort_if(Gate::denies('isAdmin'), 403);
        $data=Genre::find($id);
        return view('backend.genre.edit',compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('isAdmin'), 403);
        $validatedData = $request->validate([
            'title' => 'required',
        ]);
        $data=Genre::find($id);
        $data->title=$request->title;
        $data->save();
        $notification = [
            'message' => 'Genre edited successfully',
            'alert-type' => 'success'
        ];
        return redirect()->route('genre.index')->with($notification);
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('isAdmin'), 403);
        $data=Genre::find($id);
        $data->contents()->detach();
        $data->delete();
        $notification = [
            'message' => 'Genre deleted successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }

    public function search(Request $request)
    {
        $search = $request->input('title');
        $genre = Genre::query()->where('title', 'LIKE', "%{$search}%")->get();
        return view('backend.genre.search', compact('genre'));
    }
}
