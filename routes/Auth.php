<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

// Login
Route::get("/login", [LoginController::class, "login_page"])->name("login");
Route::post("/login", [LoginController::class, "login"])->name("login");
Route::post("/logout", [LoginController::class, "logout"])->name("logout");

// Register
Route::post("/register", [RegisterController::class, "register"])->name('register');
Route::get("/register", [RegisterController::class, "register_page_1"])->name("register.1");
Route::get("/register/step/2", [RegisterController::class, "register_page_2"])->name("register.2");
Route::get("/register/verify", [RegisterController::class, "register_page_3"])->name("register.3");
Route::post("/register/verify", [RegisterController::class, "verify"])->name("register.verify");
// Resend Code ...
Route::post("/otp/resend", [RegisterController::class, "resend"])->name("resend.otp");
