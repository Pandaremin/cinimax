<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>User dashboard</h1>
    <form method="POST" action="{{ route('logout') }}" id="logout">
        @csrf
        <a href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout').submit();">Logout</a>
    </form>
</body>
</html>