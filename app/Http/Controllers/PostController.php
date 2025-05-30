<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(1, ['id', 'slug', 'title', 'content']);
        return view('blog.index', ['posts' => $posts]);
    }

    public function show(string $slug, string $id): RedirectResponse | View  {

        $post = Post::findOrFail($id);

        if($post->slug !== $slug) {
            return to_route('articles.show', ['slug' => $post->slug, 'id' => $post->id]);
        }

        return view('blog.show', [
            'post' => $post
        ]);
    }
}
