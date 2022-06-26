<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <form action="/user/update" method="POST">
        @csrf
        @method('PUT')
        @include('components.forms.user')    
    </form>
      
    <script type="text/javascript" src="/js/user-create.js"></script>
</body>
</html>