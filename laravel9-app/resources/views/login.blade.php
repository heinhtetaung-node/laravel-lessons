<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <!-- <form action="/user/login" method="POST">
        @csrf
        @method('POST')
        <input type="email" name="email" />
        <input type="password" name="password" />
        <input type="submit" value="submit" />
    </form> -->

    <form action="/postlogin" method="POST">
        @csrf
        @method('POST')
        <input type="email" name="email" value="{{ old('email') }}"/>
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="password" name="password" />
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="submit" value="submit" />
    </form>
</body>
</html>