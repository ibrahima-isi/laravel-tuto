@extends('base')
@section('title', $post->title . ' - Blade template')

@section('content')
    <article>
        <h2>{{ $post->id }}</h2>
        <h3>{{ $post->slug }}</h3>
        <h4>{{ $post->title }}</h4>
        <p>
            {{ $post->content }}
        </p>
        <p>
            <a href="{{ route('articles.index') }}" class="btn btn-primary">Retour</a>
        </p>
    </article>
@endsection
