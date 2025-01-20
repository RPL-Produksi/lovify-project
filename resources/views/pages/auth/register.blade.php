<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
</head>
<body>
    <form action="{{ route('register') }}" method="post">
        @csrf
        <input type="text" name="fullname" placeholder="Fullname" value="{{ old('fullname') }}">
        <input type="text" name="username" placeholder="Username" value="{{ old('username') }}">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        <input type="text" name="number_phone" placeholder="Number Phone" value="{{ old('number_phone') }}">
        <select name="role">
            <option value="client">Client</option>
            <option value="mitra">Mitra</option>
        </select>
        <button type="submit">Register</button>
    </form>
    <p>Already have an Account? <a href="{{ route('login') }}">Login</a></p>
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