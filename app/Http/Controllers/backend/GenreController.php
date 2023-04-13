<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Requests\GenreRequest;


class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:isAdmin')->except('index');
    }

    public function index(Request $request)
    {
        if($request->search) {
            $genres = Genre::where('title', 'LIKE', "%{$request->search}%")->paginate();
        }
        else{
            $genres = Genre::oldest()->paginate(10);
        }
        return view('backend.genre.index', ['genres' => $genres]);
    }

    public function create()
    {
        return view('backend.genre.create');
    }

    public function store(GenreRequest $request)
    {
        $validated = $request->validated();
        Genre::create($validated);
        $notification = [
            'message' => 'Genre created successfully',
            'alert-type' => 'success'
        ];
        return to_route('genre.index')->with($notification);
    }
    
    public function edit(Genre $genre)
    {
        return view('backend.genre.edit',compact('genre'));
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        $validated = $request->validated();
        $genre->title=$request->title;
        $genre->save();
        $notification = [
            'message' => 'Genre edited successfully',
            'alert-type' => 'success'
        ];
        return to_route('genre.index')->with($notification);
    }

    public function destroy(Genre $genre)
    {
        $genre->contents()->detach();
        $genre->delete();
        $notification = [
            'message' => 'Genre deleted successfully',
            'alert-type' => 'success'
        ];
        return back()->with($notification);
    }
}
