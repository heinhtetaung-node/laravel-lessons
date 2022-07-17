<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Tuto - @yield('title')</title>
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
        .main {
            width: 100%;
            display: flex;
        }
        .side {
            width: 15%;
            display: flex;
            flex-direction: column;
        }
        .content {
            width: 80%;
        }
    </style>
</head>
<body>
    <h1>Shopping - @yield('title')</h1> 
    <div class="main">
        <div class="side">
            @section('sidemenu')
                <a href="/user">Users</a>
                <a href="/category">Category</a>
                <a href="/product">Products</a>
                <a href="/order">Order</a>
                <a href="/user/logout">Logout</a>
            @show
        </div>
        <div class="content">
            @yield('content')
        </div>
    </div>
    <hr>
    <center><div class="container">@copyright@ 2022</div></center>
</body>
</html>