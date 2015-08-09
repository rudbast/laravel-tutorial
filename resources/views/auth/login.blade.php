<!-- resources/views/auth/login.blade.php -->
@extends('app')

@section('content')
<form method="POST" action="/auth/login">
    {!! csrf_field() !!}

    <div class="form-group">
        Email
        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        Password
        <input class="form-control" type="password" name="password" id="password">
    </div>

    <div class="form-group">
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div class="form-group">
        <button class="btn btn-primary form-control" type="submit">Login</button>
    </div>
</form>
@include('errors.list')
@endsection
