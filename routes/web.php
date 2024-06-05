<?php

use App\Http\Controllers\Authlogin;
use App\Http\Controllers\Dasboard;
use App\Http\Controllers\Media\SosialController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Authlogin::class, 'loginpage'])->name('loginpage');
Route::get('/register', [Authlogin::class, 'registerpage'])->name('registerpage');
Route::post('/loginproses', [Authlogin::class, 'loginproses'])->name('loginproses');
Route::get('/logout', [Authlogin::class, 'logout'])->name('logout');
Route::post('/prosesRegiter', [Authlogin::class, 'store'])->name('prosesRegiter');


Route::group(['middleware' => ['loginaAuth']], function () {
    Route::get('/home', [Dasboard::class, 'viewhome'])->name('viewhome');
    
    Route::middleware(['checkRole:1'])->group(function () {
        Route::get('/usert', [Dasboard::class, 'viewuser'])->name('viewuser');
        Route::delete('/users/{user}', [Dasboard::class, 'destroy'])->name('users.destroy');
        Route::post('/user/add', [Dasboard::class, 'add'])->name('add.user');
    });
});

Route::group(['middleware' => ['checkSosial']], function () {
    Route::get('/sosial', [SosialController::class, 'viewcontet'])->name('viewcontet');
    Route::get('/potinga', [SosialController::class, 'posting'])->name('posting');
    Route::get('/potinga/{id_post}/edit', [SosialController::class, 'editview'])->name('posting.edit');
    Route::get('/like/{id_post}', [SosialController::class, 'likes'])->name('likes');

    Route::post('/sosial/cred', [SosialController::class, 'add'])->name('postingan.update');
    Route::post('/postinga/editpost', [SosialController::class, 'editpost'])->name('editpost');
    Route::post('/user/update', [Dasboard::class, 'update'])->name('update.user');
    Route::delete('/postinga/delate', [SosialController::class, 'deletepoting'])->name('delate.posting');

    Route::get('/commad/{id_post}', [SosialController::class, 'comend'])->name('comentar');
    Route::post('/commad/update', [SosialController::class, 'createComment'])->name('createComment');
});
