@extends('app')

@section('content')

    @if (isset($name))
        <h1>About : {!! $name !!}</h1>
    @else
        <h1>About Me: {{ $first }} {{ $last }} </h1>
    @endif

    @if (count($peoples))
        <h3>People I Like:</h3>
        <ul>
            @foreach ($peoples as $person)
                <li>{{ $person }}</li>
            @endforeach
        </ul>
    @endif

    <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </p>
@endsection
