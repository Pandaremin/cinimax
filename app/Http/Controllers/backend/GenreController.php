<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Requests\GenreRequest;
use Alert;
use Illuminate\Support\Facades\Gate;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:isAdmin')->except('index');
    }

    public function index(Request $request)
    {
        $genres = Genre::oldest();
        if($request->search) {
            $genres = Genre::where('title', 'LIKE', "%{$request->search}%");
        }
        return view('backend.genre.index', ['genres' => $genres->get()]);
    }

    public function create()
    {
        return view('backend.genre.create');
    }

    public function store(GenreRequest $request)
    {
        $validated = $request->validated();
        Genre::create($validated);
        Alert::toast('Genre Created successfully');
        return to_route('genre.index');
    }
    
    public function edit(Genre $genre)
    {
        return view('backend.genre.edit',compact('genre'));
    }

    public function update(GenreRequest $request, Genre $genre)
    {
        $validated = $request->validated();
        $genre->slug = null;
        $genre->update($validated);
        Alert::toast('Genre Updated successfully');
        return to_route('genre.index');
    }

    public function destroy(Genre $genre)
    {
        Alert::warning('Genre Deleted successfully');
        $genre->contents()->detach();
        $genre->delete();
        return back();
    }
}
