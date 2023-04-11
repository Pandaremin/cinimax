<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class AdminDashboardController extends Controller
{
    
    public function index()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('backend.dashboard',compact('user'));
    }

}
