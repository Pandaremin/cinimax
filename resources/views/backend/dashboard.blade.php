@extends('backend.layout')
@section('title','Dashboard')
@section('main')
    <h1>Admin dashboard</h1>
    <form method="POST" action="{{ route('logout') }}" id="logout">
        @csrf
        <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout').submit();">Logout</a>
    </form>
@endsection