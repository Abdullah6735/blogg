<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;

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
    $posts = Post::all();
    return Inertia::render('Welcome', [
        'posts' => $posts,
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    $permissions = $user->getAllPermissions()->pluck('name');
    return Inertia::render('Dashboard', [
        'auth' => [
            'user' => $user,
            'permissions' => $permissions,
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users', UserController::class);
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::post('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::resource('posts', PostController::class)->except(['show', 'update']);
    Route::resource('categories', CategoryController::class);
    // Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    // Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    // Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    // Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    // Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

});
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
