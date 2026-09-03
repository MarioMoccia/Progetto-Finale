<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\RevisorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'Homepage'])->name('homepage');

Route::get('/articles/create', [ArticleController::class, 'create'])->middleware('auth')->name('articles.create');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/category/{category}', [ArticleController::class, 'byCategory'])->name('articles.byCategory');

Route::get('/revisor', [RevisorController::class, 'index'])->middleware('isRevisor')->name('revisor.index');
Route::patch('/revisor/{article}/accept', [RevisorController::class, 'accept'])->middleware('isRevisor')->name('revisor.accept');
Route::patch('/revisor/{article}/reject', [RevisorController::class, 'reject'])->middleware('isRevisor')->name('revisor.reject');
Route::get('/lavora-con-noi', [RevisorController::class, 'workWithUs'])->middleware('auth')->name('work-with-us');
Route::post('/lavora-con-noi', [RevisorController::class, 'becomeRevisor'])->middleware('auth')->name('revisor.request');
Route::get('/make-revisor/{user}', [RevisorController::class, 'makeRevisor'])->middleware('isRevisor')->name('revisor.make');
