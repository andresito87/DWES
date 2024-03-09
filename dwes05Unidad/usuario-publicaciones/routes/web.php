<?php

use App\Http\Controllers\ProfileController;
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
    return view('inicio');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

use App\Http\Controllers\PostController;

Route::get('/posts', [PostController::class, 'index'])
    ->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])
    ->name('posts.store');

Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');

Route::get('/posts/{post}/edit', [PostController::class, 'edit'])
    ->name('posts.edit');

Route::put('/posts/{post}', [PostController::class, 'update'])
    ->name('posts.update');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.destroy');

// Todas las rutas de arriba se pueden generar solo con esta ruta:
// Route::resource('posts', PostController::class);

Route::get('/inicio', [PostController::class, 'main'])
    ->name('principal');

Route::get('/posts/edit/select', [PostController::class, 'editForm'])
    ->name('posts.edit.select');

Route::post('/posts/edit/select', [PostController::class, 'editById'])
    ->name('posts.edit.select.submit');

Route::get('/posts/delete/select', [PostController::class, 'delForm'])
    ->name('posts.delete.select');

Route::post('/posts/delete/select', [PostController::class, 'delById'])
    ->name('posts.delete.select.submit');

Route::get('/user-posts', [PostController::class, 'userPosts'])
    ->name('posts.user');

use App\Models\User;

Route::get('/convertir-en-admin/{id}', function ($id) {
    $user = User::findOrFail($id);
    $user->role = 'admin';
    $user->save();

    return redirect()->route('principal')
        ->with('success', 'Rol cambiado a administrador correctamente.');
});