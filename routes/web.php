<?php
// Auth
include __DIR__ . '/Auth.php';
include __DIR__ . '/SuperAdmin.php';

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect()->route('home');
})->name('index')->middleware('auth');



