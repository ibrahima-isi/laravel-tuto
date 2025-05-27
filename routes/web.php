<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// creation d'une route et utilisation de la class Request pour recuperer les données envoyés par la requete
// Class Request remplace les Super Variable $_GET $_POST ... de php native
Route::get('/hello-world', function(Request $request){
    $param = $request->path();
    return [
        "path" => $param,
        "hello" => "Hello, World !"
    ];
})->name('hello');

// Utilisation des clauses: Where pour personnaliser les parametres de la requete
Route::get('/custom-url/{slug}-{id}', function(string $slug, string $id){
    return [
        'slug' => $slug,
        'id' => $id
    ];
})->where([
    'id' => '^[0-9]+$',
    'slug' => '[a-zA-Z0-9\-]+',
])->name('custom');

// Grouper des routes et definir un nom commun de base
Route::prefix('/articles')->name('articles.')->group(function(){
    Route::get('/', function(){
        $post = new Post();
        // $post->title = "Mon article";
        // $post->slug = "mon-second-article";
        // $post->content = "le contenu";
        // $post->save();

        return $post->all(['id', 'title']);

        return [
            'path' => '/articles',
            'name' => 'articles.index',
        ];
    })->name('index');

    Route::get('/create', function () {
        return [
            'path' => '/articles/create',
            'name' => 'articles.create',
        ];
    })->name('create');

    Route::get('/update', function () {
        return [
            'path' => '/articles/update',
            'name' => 'articles.update',
        ];
    })->name('update');

    Route::get('/show/{slug}-{id}', [PostController::class, 'show'])
    ->where([
        'id' => '^[0-9]+$',
        'slug' => '[a-zA-Z0-9\-]+',
    ])
    ->name('show');
});