<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatImageController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [CatImageController::class, 'index'])->name('cats.index'); 
Route::get('/cats/tag/{tag}', [CatImageController::class, 'filterByTag'])->name('cats.filter');
