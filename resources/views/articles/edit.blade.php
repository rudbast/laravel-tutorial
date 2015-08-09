@extends('app')

@section('content')
    <h1>Edit: {!! $article->title !!}</h1>
    <hr/>

    {!! Form::model($article, ['method' => 'PATCH', 'url' => 'articles/'.$article->id]) !!}
        @include('articles.form', ['submitButtonText' => 'Edit Article'])
    {!! Form::close() !!}

    @include('errors.list')
@endsection
