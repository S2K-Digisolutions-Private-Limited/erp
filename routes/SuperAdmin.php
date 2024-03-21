<?php


use App\Http\Controllers\School\Admin\Classes;
use App\Http\Controllers\School\Admin\SectionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ---------------------------- Step To School Status ---------------------------------------------\\
Route::group(["middleware" => ["auth", "auth:school", "step.check"]], function () {
    //-------------------------------------- Home Route Start---------------------------------------\\
    Route::inertia('/dashboard', 'Home')->name('home');

    // -------------------------Classes CRUD ------------------------\\
    Route::group(['prefix' => '/class'], function () {
        Route::get('/', [Classes::class, 'index'])->name('class.index');
        Route::get('/create', [Classes::class, 'create_page'])->name('class.create');
        Route::get('/{id}/edit', [Classes::class, 'edit_page'])->name('class.edit');
        Route::post('/insert', [Classes::class, 'insert'])->name('class.insert');
        Route::delete('/{id}/delete', [Classes::class, 'delete'])->name('class.delete');
    });

    Route::group(['prefix' => '/section'], function () {
        Route::get('/', [SectionController::class, 'index'])->name('section.index');
        Route::get('/create', [SectionController::class, 'create_page'])->name('section.create');
        Route::get('/{id}/edit', [SectionController::class, 'edit_page'])->name('section.edit');
        Route::post('/insert', [SectionController::class, 'insert'])->name('section.insert');
        Route::delete('/{id}/delete', [SectionController::class, 'delete'])->name('section.delete');
    });
























});
