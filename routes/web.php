<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/inicio', [HomeController::class, 'index'])->name('home');

Route::prefix('negocios')->name('businesses.')->group(
    function() {
        Route::get('crear', [BusinessController::class, 'create'])->name('create');
        Route::post('guardar', [BusinessController::class, 'store'])->name('store');
        Route::prefix('{business}')->group(
            function () {
                Route::get('', [BusinessController::class, 'show'])->name('show');
                Route::get('editar', [BusinessController::class, 'edit'])->name('edit');
                Route::put('actualizar', [BusinessController::class, 'update'])->name('update');
            }
        );
    }
);

require base_path('routes/web-admin.php');
