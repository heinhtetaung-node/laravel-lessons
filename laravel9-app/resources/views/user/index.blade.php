<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello User</title>
</head>
<body>
    <h1>Users</h1>    
    <a href="/user/create2">Ceate User</a>
    <a href="/user/logout">Logout</a>
    @foreach ($users as $user) 
        <p>{{ $user['name'] }} - {{ $user['email'] }} </p>
        <a href="/user/{{ $user['id'] }}"><button>Edit</button></a> 

        <form action="/user/delete/{{ $user['id'] }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endforeach
    <hr>    
</body>
</html>