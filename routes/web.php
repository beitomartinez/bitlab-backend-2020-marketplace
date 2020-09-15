<?php

use App\Http\Controllers\{
    BusinessOwnerController,
    BusinessController,
    BusinessProductController,
    BusinessScheduleController,
    HomeController
};
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/inicio', [HomeController::class, 'index'])->name('home');

Route::prefix('negocios')->name('businesses.')->group(
    function() {
        Route::get('', [BusinessController::class, 'index'])->name('index');
        Route::prefix('{business}')->group(
            function () {
                Route::get('', [BusinessController::class, 'show'])->name('show');
            }
        );
    }
);

Route::prefix('mis-negocios')->name('my-businesses.')->group(
    function() {
        Route::get('', [BusinessOwnerController::class, 'index'])->name('index');
        Route::get('crear', [BusinessOwnerController::class, 'create'])->name('create');
        Route::post('guardar', [BusinessOwnerController::class, 'store'])->name('store');
        Route::prefix('{business}')->group(
            function () {
                Route::get('', [BusinessOwnerController::class, 'show'])->name('show');
                Route::get('editar', [BusinessOwnerController::class, 'edit'])->name('edit');
                Route::put('actualizar', [BusinessOwnerController::class, 'update'])->name('update');
                Route::put('borrar', [BusinessOwnerController::class, 'destroy'])->name('destroy');

                Route::prefix('productos')->name('products.')->group(
                    function () {
                        Route::get('', [BusinessProductController::class, 'index'])->name('index');
                        Route::get('crear', [BusinessProductController::class, 'create'])->name('create');
                        Route::post('guardar', [BusinessProductController::class, 'store'])->name('store');

                        Route::prefix('{product}')->group(
                            function () {
                                Route::get('', [BusinessProductController::class, 'show'])->name('show');
                                Route::get('editar', [BusinessProductController::class, 'edit'])->name('edit');
                                Route::put('actualizar', [BusinessProductController::class, 'update'])->name('update');
                                Route::put('borrar', [BusinessProductController::class, 'destroy'])->name('destroy');
                            }
                        );
                    }
                );
                
                Route::prefix('horarios')->name('schedules.')->group(
                    function () {
                        Route::get('', [BusinessScheduleController::class, 'index'])->name('index');
                        Route::get('crear', [BusinessScheduleController::class, 'create'])->name('create');
                        Route::post('guardar', [BusinessScheduleController::class, 'store'])->name('store');

                        // Route::prefix('{product}')->group(
                        //     function () {
                        //         Route::get('', [BusinessScheduleController::class, 'show'])->name('show');
                        //         Route::get('editar', [BusinessScheduleController::class, 'edit'])->name('edit');
                        //         Route::put('actualizar', [BusinessScheduleController::class, 'update'])->name('update');
                        //         Route::put('borrar', [BusinessScheduleController::class, 'destroy'])->name('destroy');
                        //     }
                        // );
                    }
                );
            }
        );
    }
);

require base_path('routes/web-admin.php');
