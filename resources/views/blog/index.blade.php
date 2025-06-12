@extends('base')
@section('title', 'Blade template')

@section('content')
    <h1>Index</h1>

   <div class="container">
       @if(session('success'))
          <span class="text-success">{{ session('success') }}</span>
       @elseif(session('error'))
           <span class="text-success">{{ session('error') }}</span>
       @endif
   </div>

    <div class="container m-3">
        @foreach($posts as $post)
            <article class="m-1">
                <h3>Title: {{ $post->title }}</h3>
                <h4>Slug: {{ $post->slug }}</h4>
                <p>
                    <a href="{{ route('articles.show', ['post' => $post->slug]) }}" class="btn btn-primary">Voir plus</a>
                </p>
            </article>
        @endforeach
    </div>

    {{ $posts->links() }}
@endsection
