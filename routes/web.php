<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');
    Route::group(['prefix' => 'document'], function () {
        Route::get('/', [App\Http\Controllers\Admin\DocumentsController::class, 'index'])->name('admin.documents.home');
        Route::get('/create', [App\Http\Controllers\Admin\DocumentsController::class, 'create'])->name('admin.documents.create');
        Route::get('/edit/{document}', [App\Http\Controllers\Admin\DocumentsController::class, 'edit'])->name('admin.documents.edit');
        Route::post('/create', [App\Http\Controllers\Admin\DocumentsController::class, 'store'])->name('admin.documents.store');
        Route::patch('/{document}', [App\Http\Controllers\Admin\DocumentsController::class, 'update'])->name('admin.documents.update');
        Route::delete('/{document}', [App\Http\Controllers\Admin\DocumentsController::class, 'delete'])->name('admin.documents.delete');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.home');
        Route::delete('/{user}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('admin.users.delete');
    });
});
