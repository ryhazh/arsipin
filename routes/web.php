<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenreCategoryController;



Route::middleware(['auth', RoleMiddleware::class])->group(function () {

    Route::get('/', function () {
        return redirect()->route('books.index');
    });

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

    Route::post('/genres', [GenreController::class, 'store'])->name('genre.store');
    Route::get('/genrescategories', [GenreCategoryController::class, 'index'])->name('genrecategory.index');
    Route::put('/genre/{genre}', [GenreController::class, 'update'])->name('genre.update');
    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::delete('/genre/{genre}', [GenreController::class, 'destroy'])->name('genre.destroy');




    Route::get('/records', [RecordController::class, 'index'])->name('records.index');
    Route::post('/records', [RecordController::class, 'store'])->name('records.store');
    Route::put('/records/{record}', [RecordController::class, 'update'])->name('records.update');
    Route::patch('/recordsreturn/{id}', [RecordController::class, 'return'])->name('records.return');

    Route::get('/records/requests', [RecordController::class, 'requests'])->name('records.requests');
    Route::patch('/records/requests/{id}', [RecordController::class, 'approve'])->name('records.approve');
    Route::delete('/records/requests/{id}', [RecordController::class, 'reject'])->name('records.reject');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

// user only page
Route::get('/dashbook', [BookController::class, 'userIndex'])
    ->middleware('auth')
    ->name('books.userindex');

Route::get('/dashbook/requests', [RecordController::class,'userRequests'])
    ->middleware('auth')
    ->name('records.userrequests');
    
Route::get('/dashbook/borrowed', [RecordController::class,'userBorrowed'])
    ->middleware('auth')
    ->name('records.userborrowed');

Route::post('/borrow', [RecordController::class, 'borrow'])->name('records.borrow');


Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//login route
Route::get('/login', function () {
    return view('auth.login');
})->name('loginpage');



Route::get('/register', function () {
    return view('auth.register');
})->name('register');
