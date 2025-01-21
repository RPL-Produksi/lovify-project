<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <form action="{{ route('login')}}" method="post">
        @csrf
        @if ($isAdmin)
            <input type="hidden" name="admin" value="true">
        @endif
        <input type="text" name="login" placeholder="Username or Email" value="{{ old('login') }}">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
    <p>Didn't have an Account? <a href="{{ route('register') }}">Register</a></p>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</body>
</html>