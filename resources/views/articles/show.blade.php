@extends('app')

@section('content')
    <article>
        <div class="jumbotron">
            <h1>{{ $article->title }}</h1>
            {{ $article->body }}

            @unless ($article->tags->isEmpty())
                <br/>

                @foreach ($article->tags as $tag)
                    <span class="label label-info">{{ $tag->name }}</span>
                @endforeach
            @endunless

            @if (Auth::check())
                <br/>
                <br/>
                <a class="btn btn-primary btn-md" href="{{ action('ArticlesController@edit', $article->id) }}" role="button">Edit</a>
            @endif
        </div>
    </article>
@endsection
