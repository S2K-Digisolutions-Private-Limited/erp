<?php


use App\Http\Controllers\School\Admin\Classes;
use App\Http\Controllers\School\Admin\HomeController;
use App\Http\Controllers\School\Admin\SectionController;
use App\Http\Controllers\School\Admin\StreamController;
use App\Http\Controllers\School\Admin\StudentController;
use App\Http\Controllers\School\Admin\SubjectController;
use App\Http\Controllers\School\SuperAdmin\EmailHistory;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// ---------------------------- Step To School Status ---------------------------------------------\\
Route::group(["middleware" => ["auth", "auth:school", "step.check"]], function () {
    //-------------------------------------- Home Route Start---------------------------------------\\
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

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
    Route::group(['prefix' => '/stream'], function () {
        Route::get('/', [StreamController::class, 'index'])->name('stream.index');
        Route::get('/create', [StreamController::class, 'create_page'])->name('stream.create');
        Route::get('/{id}/edit', [StreamController::class, 'edit_page'])->name('stream.edit');
        Route::post('/insert', [StreamController::class, 'insert'])->name('stream.insert');
        Route::delete('/{id}/delete', [StreamController::class, 'delete'])->name('stream.delete');
    });

    // subject
    Route::group(['prefix' => '/subject'], function () {
        Route::get('/', [SubjectController::class, 'index'])->name('subject.index');
        Route::get('/create', [SubjectController::class, 'create_page'])->name('subject.create');
        Route::get('/{id}/edit', [SubjectController::class, 'edit_page'])->name('subject.edit');
        Route::post('/insert', [SubjectController::class, 'insert'])->name('subject.insert');
        Route::delete('/{id}/delete', [SubjectController::class, 'delete'])->name('subject.delete');
    });

    Route::group(['prefix' => '/student'], function () {
        Route::get('/', [StudentController::class, 'index'])->name('student.index');
        Route::get('/create', [StudentController::class, 'create'])->name('student.create');
        Route::get('/edit/{slug}', [StudentController::class, 'edit'])->name('student.edit');
        Route::post('/create/{id}', [StudentController::class, 'insert'])->name('student.insert');
    });

























});
