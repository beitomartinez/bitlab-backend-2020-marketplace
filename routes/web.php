<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

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
    }
);
