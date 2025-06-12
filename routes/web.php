<?php

use App\Http\Controllers\PostController;
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

// Creation d'une route et utilisation de la class Request pour recuperer les données envoyées par la requete
// Class Request remplace les Super Variables $_GET $_POST ... de php native
Route::get('/hello-world', function (Request $request) {
    $param = $request->path();
    return [
        "path" => $param,
        "hello" => "Hello, World !"
    ];
})->name('hello');

// Utilisation des clauses: Where pour personnaliser les parametres de la requete
Route::get('/custom-url/{slug}-{id}', function (string $slug, string $id) {
    return [
        'slug' => $slug,
        'id' => $id
    ];
})->where([
    'id' => '^[0-9]+$',
    'slug' => '[a-zA-Z0-9\-]+',
])->name('custom');

// Grouper des routes et definir un nom commun de base
Route::prefix('/articles')->name('articles.')->controller(PostController::class) ->group(function () {

    Route::get('/', 'index')->name('index');

//    Route::get('/create', function () {
//        return [
//            'path' => '/articles/create',
//            'name' => 'articles.create',
//        ];
//    })->name('create');

//    Route::get('/update', function () {
//        return [
//            'path' => '/articles/update',
//            'name' => 'articles.update',
//        ];
//    })->name('update');

//    Route::get('/show/{slug}-{id}', [PostController::class, 'show'])
//        ->where([
//            'id' => '^[0-9]+$',
//            'slug' => '[a-zA-Z0-9\-]+',
//        ])
//        ->name('show');
//});
    // Model Binding
//    Route::get('/show/{post}', [PostController::class, 'show'])
//        ->where([
//            'id' => '^[0-9]+$',
//            'slug' => '[a-zA-Z0-9\-]+',
//        ])
//        ->name('show');
//    });
    // Customize the search key or field
    Route::get('/show/{post:slug}','show')
        ->where([
            'id' => '^[0-9]+$',
            'slug' => '[a-zA-Z0-9\-]+',
        ])
        ->name('show');

    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/edit/{post}', 'edit')->name('edit');
    Route::patch('/update/{post}', 'update')->name('update');
    Route::delete('/delete/{post}', 'destroy')->name('delete');
});

