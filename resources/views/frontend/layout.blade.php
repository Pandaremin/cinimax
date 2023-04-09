<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>User Home Page</h1>
    @guest
    <a href="{{route('login')}}" >Login</a>
    <a href="{{route('register')}}" >Register</a>
    @endguest
    @auth
    <form method="POST" action="{{ route('logout') }}" id="logout">
        @csrf
        <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout').submit();">Logout</a>
    </form>
    @endauth
</body>
</html>