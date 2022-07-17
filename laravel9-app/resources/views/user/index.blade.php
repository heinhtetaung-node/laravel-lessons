@extends('layout')
 
@section('title', 'User')

 
@section('sidemenu')
    @parent
    <hr>
    <a href="/user/create2">Ceate User</a>
    <form action="/user" method="GET">
        Name 
        <br />
        <input type="text" value="{{ request()->get('name') }}" name="name" />
        <br />
        (Or)
        <br />
        Nickname 
        <br />
        <input type="text" value="{{ request()->get('nickname') }}" name="nickname" />
        <br />
        Address 
        <br />
        <input type="text" value="{{ request()->get('address') }}" name="address" />
        <br />
        Email
        <br />
        <input type="email" name="email" value="{{ request()->get('email') }}" />
        <br />
        Order By <select  name="orderBy">
            <option {{ request()->get('orderBy') == 'id' ? 'selected' : '' }} value="id">ID</option>
            <option {{ request()->get('orderBy') == 'name' ? 'selected' : '' }} value="name">Name</option>
            <option {{ request()->get('orderBy') == 'email' ? 'selected' : '' }} value="email">Email</option>
        </select>
        <br />
        Order <select name="order">
            <option {{ request()->get('order') == 'desc' ? 'selected' : '' }}  value="desc">Desc</option>
            <option {{ request()->get('order') == 'asc' ? 'selected' : '' }}  value="asc">Asc</option>
        </select>
        <br />
        <button>Search</button>        
    </form>
@endsection


@section('content') 


@foreach ($users as $user) 
    <p>{{ $user['id'] }} - {{ $user['name'] }} - {{ $user['nickname'] }} - {{ $user['email'] }} </p>
    <p>{{ $user['address'] }}</p>
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
@endsection
