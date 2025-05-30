@extends('base')
@section('title', 'Blade template')

@section('content')
    <h1>Mon blog From Index</h1>
{{--    @dump($posts)--}}
    @foreach($posts as $post)
        <article>
            <h3>{{ $post->id }}</h3>
            <h4>{{ $post->title }}</h4>
            <p>
                <a href="{{ route('articles.show', ['slug' => $post->slug, 'id' => $post->id]) }}" class="btn btn-primary">Voir plus</a>
            </p>
        </article>
    @endforeach
    {{ $posts->links() }}
@endsection
