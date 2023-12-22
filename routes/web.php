<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TodoController;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('todos', [TodoController::class, 'index'])->name('todos.index');
    Route::get('todos/create', [TodoController::class, 'create'])->name('todos.create');
    Route::post('todos/store', [TodoController::class, 'store'])->name('todos.store');
    Route::get('todos/show/{id}', [TodoController::class, 'show'])->name('todos.show');
    Route::get('todos/edit/{id}', [TodoController::class, 'edit'])->name('todos.edit');
    Route::put('todos/update', [TodoController::class, 'update'])->name('todos.update');
    Route::delete('todos/destroy', [TodoController::class, 'destroy'])->name('todos.destroy');
    Route::get('todos/search_data', [TodoController::class, 'search_data']);
    Route::get('search_data', [TodoController::class, 'search_data']);



        // // Todos routes with user ID
        // Route::get('todos', [TodoController::class, 'index'])->name('todos.index');
        // Route::get('todos/create', [TodoController::class, 'create'])->name('todos.create');
        // Route::post('todos/store', [TodoController::class, 'store'])->name('todos.store');
    
        // // Use route parameter to pass user ID
        // Route::get('todos/show/{user_id}/{id}', [TodoController::class, 'show'])->name('todos.show');
        // Route::get('todos/edit/{user_id}/{id}', [TodoController::class, 'edit'])->name('todos.edit');
        // Route::put('todos/update/{user_id}', [TodoController::class, 'update'])->name('todos.update');
        // Route::delete('todos/destroy/{user_id}', [TodoController::class, 'destroy'])->name('todos.destroy');
});



require __DIR__ . '/auth.php';
