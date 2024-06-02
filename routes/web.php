<?php

use App\Http\Controllers\Authlogin;
use App\Http\Controllers\Dasboard;
use Illuminate\Support\Facades\Route;

Route::get('/',[Authlogin::class,'loginpage'])->name('loginpage');
Route::get('/register',[Authlogin::class,'registerpage'])->name('registerpage');
Route::post('/loginproses', [Authlogin::class,'loginproses'])->name('loginproses');
Route::get('/logout', [Authlogin::class,'logout'])->name('logout');



Route::post('/prosesRegiter',[Authlogin::class,'store'])->name('prosesRegiter');


Route::group(['middleware' => ['loginaAuth']], function() {
    Route::get('/home', [Dasboard::class,'viewhome'])->name('viewhome');
    Route::post('/user/update', [Dasboard::class, 'update'])->name('update.user');
    Route::post('/user/add', [Dasboard::class, 'add'])->name('add.user');
    Route::delete('/users/{user}', [Dasboard::class, 'destroy'])->name('users.destroy');

    Route::middleware(['checkRole:1'])->group(function () {
        Route::get('/usert', [Dasboard::class, 'viewuser'])->name('viewuser');
    });
});