<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenresController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
// ROUTE AUTH
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/login', [AuthController::class, 'actionLogin'])->name('auth.actionLogin');
Route::post('/register',[AuthController::class, 'ActionRegister'])->name('action.register');
// END ROUTE AUTH

});


// ROUTE GENRE
Route::get('/genre',[GenresController::class, 'index'])->name('genre.index');
Route::get('/genre/create',[GenresController::class,'create'])->name('genre.create');
Route::post('/genre/create',[GenresController::class,'store'])->name('genre.store');
Route::get('/genre/edit/{id}',[GenresController::class,'edit'])->name('genre.edit');
Route::put('/genre/edit/{id}',[GenresController::class,'update'])->name('genre.update');
Route::delete('/genre/delete/{id}',[GenresController::class,'destroy'])->name('genre.destroy');
//END ROUTE GENRE

Route::middleware('auth')->group(function () {
// Route author
Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('/author', [AuthorsController::class,'index'])->name('penulis.index');
Route::get('/author/create', [AuthorsController::class,'create'])->name('penulis.create');
Route::post('/author/create', [AuthorsController::class , 'store'])->name('penulis.store');
Route::get('/author/show/{id}', action: [AuthorsController::class , 'show'])->name('penulis.show');
Route::get('/author/edit/{id}', action: [AuthorsController::class , 'edit'])->name('penulis.edit');
Route::delete('/author/delete/{id}', [AuthorsController::class , 'destroy'])->name('penulis.destroy');
Route::put('/author/update/{id}', [AuthorsController::class , 'update'])->name('penulis.update');
    // END Route author

    // Open Avatar
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar');
    Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar'])->name('profile.remove');
// Close Avatar

// Route Books
Route::get( '/books', [BooksController::class,'index'])->name('books.index');
Route::get( '/books/create', [BooksController::class,'create'])->name(name: 'books.create');
Route::post( '/books/create', [BooksController::class,'store'])->name(name: 'books.store');
Route::get( '/books/detail/{id}', [BooksController::class,'detail'])->name(name: 'books.detail');
Route::delete( '/books/detail/{id}', [BooksController::class,'destroy'])->name(name: 'books.delete');
Route::get( '/books/edit/{id}', [BooksController::class,'edit'])->name(name: 'books.edit');
Route::put( '/books/update/{id}', [BooksController::class,'update'])->name(name: 'books.update');
// End Route Books

});


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');