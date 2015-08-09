<!-- resources/views/auth/register.blade.php -->

@extends('app')

@section('content')
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}

    <div class="form-group">
        Name
        <input class="form-control" type="text" name="username" value="{{ old('username') }}">
    </div>

    <div class="form-group">
        Email
        <input class="form-control" type="email" name="email" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        Password
        <input class="form-control" type="password" name="password">
    </div>

    <div class="form-group">
        Confirm Password
        <input class="form-control" type="password" name="password_confirmation">
    </div>

    <div class="form-group">
        <button class="btn btn-primary form-control" type="submit">Register</button>
    </div>
</form>
@include('errors.list')
@endsection
