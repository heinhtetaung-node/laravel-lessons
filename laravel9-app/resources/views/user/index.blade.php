<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello User</title>
</head>
<body>
    <h1>User</h1>
    Hello <h2>{{ $username }}</h2>
    
    @foreach ($users as $user) 
        <p>{{ $user['name'] }}</p>
    @endforeach
    <hr>
    1. {{ $singleuser['id'] }} - {{ $singleuser['name'] }}
</body>
</html>