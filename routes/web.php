<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts');
});

Route::get('posts/{post}', function ($slug) {

    if (! file_exists($path = __DIR__ . "/../resources/posts/{$slug}.html")) {
        //dd('el archivo no existe');
        //ddd('el archivo no existe');
        //abort(404);
        return redirect('/');
    };

    $post = cache()->remember("posts.{$slug}", 3600, fn () => file_get_contents($path));

    return view('post', ['post' => $post]);

})->where('post', '[A-z_\-]+'); 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');