<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(1, ['id', 'slug', 'title', 'content']);
        return view('blog.index', ['posts' => $posts]);
    }

    public function show(Post $post): RedirectResponse | View
    {
        return view('blog.show', [
            'post' => $post
        ]);
    }

    public function create()
    {
        return view('blog.form', ['post' => new Post()]);
    }

    public function store(PostRequest $postRequest)
    {
        $post = Post::create([
            'title' => $postRequest->input('title'),
            'slug' => $postRequest->input('slug'),
            'content' => $postRequest->input('content'),
        ]);

        return to_route('articles.show', ['post' => $post])->with('success', 'Post created successfully');
    }

    // edit
    public function edit(Post $post)
    {
        return view('blog.form', ['post' => $post]);
    }

    public function update(PostRequest $postRequest, Post $post)
    {
        // update with the validated data
        $post->update( $postRequest->validated() );

        return to_route('articles.show', $post)->with('success', 'Post updated successfully');
    }

    /**
     * @throws \Throwable
     */
    public function destroy(Post $post)
    {
        try {
            $post->deleteOrFail();
            return to_route('articles.index')->with('success', 'Article deleted !');
        }catch (ModelNotFoundException $exception){
            return to_route('articles.index')->with('error', 'Article introuvable');
        }
    }

}
