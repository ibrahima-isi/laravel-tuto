@extends('base')
@section('title',$post->title ? $post->title . ' - Modifier un post' : 'Creer un post')

@section('content')
    <form class="m-3" action="{{ $post->id ? route('articles.update', $post) : route('articles.store') }}" method="POST">
        @csrf
        @if($post->id)
            @method('PATCH')
        @endif
        <div class="form-group m-3">
            <label for="title" class="form-label">Title</label>
            <input type="text"  class="form-control" name="title" id="title" value="{{ old('title', $post->title) }}" placeholder="Post title">
            <span class="text-danger">
                @error('title') {{ $message }}  @enderror
            </span>
        </div>
        <div class="form-group m-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug',$post->slug) }}" placeholder="Post slug">
            <span class="text-danger">
                @error('slug') {{ $message }}  @enderror
            </span>
        </div>
        <div class="form-group m-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control">{{ old('content' , $post->content) }}</textarea>
            <span class="text-danger">
                @error('content') {{ $message }}  @enderror
            </span>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary m-3">Enregistrer</button>
            <button type="reset" class="btn btn-secondary m-3">Clear</button>
            <a href="{{ route('articles.index') }}" class="btn btn-info m-3">Retour</a>
        </div>
    </form>
@endsection
