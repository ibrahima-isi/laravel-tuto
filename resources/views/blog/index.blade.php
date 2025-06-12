@extends('base')
@section('title', 'Blade template')

@section('content')
    <h1>Index</h1>
{{--    @dump($posts)--}}
    <div class="container m-3">
        @foreach($posts as $post)
            <article class="m-1">
                <h3>Title: {{ $post->title }}</h3>
                <h4>Slug: {{ $post->slug }}</h4>
                <p>
                    <a href="{{ route('articles.show', ['slug' => $post->slug, 'post' => $post->id]) }}" class="btn btn-primary">Voir plus</a>
                </p>
            </article>
        @endforeach
    </div>

    {{ $posts->links() }}
@endsection
