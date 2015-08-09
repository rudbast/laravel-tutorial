@extends('app')

@section('content')
    <h1>Articles</h1>
    <hr />

    @foreach ($articles as $article)
        <article>
            <h2>
                {{-- <a href="/articles/{{ $article->id }}">{{ $article->title }}</a> --}}
                {{-- <a href="{{ action('ArticlesController@show', [$article->id]) }}">{{ $article->title }}</a> --}}
                <a href="{{ url('/articles', $article->id) }}">{{ $article->title }}</a>
            </h2>
            <div class="body">
                {{ $article->body }}

                @unless ($article->tags->isEmpty())
                    <br/>
                    {{-- <ul>
                        <li class="" style="display:inline;"></li>

                    </ul> --}}
                    @foreach ($article->tags as $tag)
                        <span class="label label-info">{{ $tag->name }}</span>
                    @endforeach
                @endunless
            </div>
        </article>
    @endforeach
@endsection
