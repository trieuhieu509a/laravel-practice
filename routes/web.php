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

// Route::get('/', function () {
//   return view('home.index', []);
// })->name('home.index');

// Route::get('/contact', function () {
//   return view('home.contact');
// })->name('home.contact');

Route::view('/', 'home.index')
    ->name('home.index');
Route::view('/contact', 'home.contact')
    ->name('home.contact');

$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ],
    3 => [
        'title' => 'Intro to Golang',
        'content' => 'This is a short intro to Golang',
        'is_new' => false
    ]
];

Route::get('/posts', function () use ($posts) {
    // compact($posts) === ['posts' => $posts])
    return view('posts.index', ['posts' => $posts]);
});

Route::get('/posts/{id}', function ($id) use ($posts) {
    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
})
    // ->where([
    //     'id' => '[0-9]+'
    // ])
    ->name('posts.show');

Route::get('/recent-posts/{days_ago?}', function ($daysAgo = 20) {
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index');

Route::get('/fun/responses', function() use($posts) {
    return response($posts, 201)
        ->header('Content-Type', 'application/json')
        ->cookie('MY_COOKIE', 'Piotr Jura', 3600);
});

Route::get('/fun/redirect', function() {
    return redirect('/contact');
});

Route::get('/fun/back', function() {
    return back();
});

Route::get('/fun/named-route', function() {
    return redirect()->route('posts.show', ['id' => 1]);
});

Route::get('/fun/away', function() {
    return redirect()->away('https://google.com');
});

Route::get('/fun/json', function() use($posts) {
    return response()->json($posts);
});

Route::get('/fun/download', function() use($posts) {
    return response()->download(public_path('/daniel.jpg'), 'face.jpg');
});
