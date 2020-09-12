<?php

use App\Http\Controllers\Admin\{CategoryController, UserController};

Route::prefix('admin')->name('admin.')->middleware('admin')->group(
    function () {
        Route::get('dashboard', 'Admin\DashboardController')->name('dashboard');

        Route::prefix('categories')->name('categories.')->group(
            function () {
                Route::get('', [CategoryController::class, 'index'])->name('index');
                Route::view('create', 'admin.categories.create')->name('create');
                Route::post('store', [CategoryController::class, 'store'])->name('store');

                Route::prefix('{category}')->group(
                    function () {
                        Route::get('', [CategoryController::class, 'show'])->name('show');
                        Route::put('', [CategoryController::class, 'update'])->name('update');
                        Route::delete('', [CategoryController::class, 'destroy'])->name('destroy');
                    }
                );
            }
        );

        Route::prefix('users')->name('users.')->group(
            function () {
                Route::get('', [UserController::class, 'index'])->name('index');

                Route::prefix('{user}')->group(
                    function () {
                        Route::get('', [UserController::class, 'show'])->name('show');
                        Route::put('', [UserController::class, 'update'])->name('update');
                        Route::delete('', [UserController::class, 'destroy'])->name('destroy');
                        Route::post('restore', [UserController::class, 'restore'])->name('restore');
                    }
                );
            }
        );
    }
);