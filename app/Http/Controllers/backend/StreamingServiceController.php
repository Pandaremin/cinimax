<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StreamingService;
use Alert;

class StreamingServiceController extends Controller
{
    public function index()
    {
        return view('backend.streaming.index', ['streamingServices' => StreamingService::all()]);
    }

    public function create()
    {
        return view('backend.streaming.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
        ]);
        StreamingService::create($validated);
        Alert::toast('Streaming Service Created successfully');
        return to_route('streamingservice.index');
    }
    
    public function edit(StreamingService $streamingservice)
    {
        return view('backend.streaming.edit',compact('streamingservice'));
    }

    public function update(Request $request, StreamingService $streamingservice)
    {
        $validated = $request->validate([
            'title' => 'required',
        ]);
        $streamingservice->update($validated);
        Alert::toast('Streaming Service Updated successfully');
        return to_route('streamingservice.index');
    }

    public function destroy(StreamingService $streamingservice)
    {
        Alert::toast('Streaming Service Deleted successfully');
        $streamingservice->delete();
        return back();
    }
}
