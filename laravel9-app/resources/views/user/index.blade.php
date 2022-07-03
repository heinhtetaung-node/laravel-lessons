<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hello User</title>
    <style>
        .cus-pagination svg {
            width: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .cus-pagination span {
            display: flex;
        }
        .cus-pagination a {
            margin: 5px;
            margin-bottom: 0px;
        }
        .cus-pagination span[aria-current=page] {
            margin: 5px;
            margin-bottom: 0px;
        }
        .cus-pagination p {
            display: flex;
        }
        .cus-pagination nav div:first-child {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Users</h1>    
    <a href="/user/create2">Ceate User</a>
    <a href="/user/logout">Logout</a>
    
    <form action="/user" method="GET">
        @csrf
        @method('GET')
        <select  name="orderBy">
            <option {{ request()->get('orderBy') == 'id' ? 'selected' : '' }} value="id">ID</option>
            <option {{ request()->get('orderBy') == 'name' ? 'selected' : '' }} value="name">Name</option>
            <option {{ request()->get('orderBy') == 'email' ? 'selected' : '' }} value="email">Email</option>
        </select>
        <select name="order">
            <option {{ request()->get('order') == 'desc' ? 'selected' : '' }}  value="desc">Desc</option>
            <option {{ request()->get('order') == 'asc' ? 'selected' : '' }}  value="asc">Asc</option>
        </select>
        <button>Search</button>        
    </form>
    
    @foreach ($users as $user) 
        <p>{{ $user['id'] }} - {{ $user['name'] }} - {{ $user['email'] }} </p>
        <a href="/user/{{ $user['id'] }}"><button>Edit</button></a> 

        <form action="/user/delete/{{ $user['id'] }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
    @endforeach
    <br>
    <div class="cus-pagination">
    {{ $users->links() }}    
    </div>

    <hr>    

</body>
</html>