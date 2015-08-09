<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Set a title']) !!}
</div>

<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'Type the description']) !!}
</div>

<div class="form-group">
    {!! Form::label('published_at', 'Published On:') !!}
    {!! Form::input('date', 'published_at', $article->published_at, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tag_list', 'Tags:') !!}
    {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>

@section('footer')
    <script type="text/javascript">
        $('#tag_list').select2({
            placeholder: 'Choose a tag',
            // tags: true,
            // data: [
            //     {id: 'one', text: 'One'},
            //     {id: 'two', text: 'Two'},
            // ],
            // ajax: {
            //     dataType: 'json',
            //     url: 'api/tags',
            //     delay: 250,
            //     data: function(params) {
            //         return {
            //             q: params.term;
            //         }
            //     },
            //     processResults: function(data) {
            //         return { results: data.property };
            //     }
            // }
        });
    </script>
@endsection
