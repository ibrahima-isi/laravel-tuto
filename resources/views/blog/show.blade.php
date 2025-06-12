@extends('base')
@section('title', $post->title . ' - Blade template')

@section('content')
 @if(session('success'))
     <div class="alert alert-success">
         {{ session('success') }}
     </div>
 @endif
    <article>
        <h2>ID - {{ $post->id }}</h2>
        <h3>Title - {{ $post->title }}</h3>
        <h5>Slug - {{ $post->slug }}</h5>
        <h6>Content</h6>
        <p>
            {{ $post->content }}
        </p>
        <div class="d-flex justify-content-between m-3">
            <a href="{{ route('articles.index') }}" class="btn btn-primary m-3">Retour</a>
            <a href="{{ route('articles.edit', $post) }}" class="btn btn-info m-3">Modifier</a>
            <form action="{{ route('articles.delete', $post) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger m-3">Delete</button>
            </form>
        </div>
    </article>
@endsection
