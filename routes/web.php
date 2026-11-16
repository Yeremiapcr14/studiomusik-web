<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Halaman Beranda pelanggan (menggantikan route 'welcome' bawaan Laravel)
Route::get('/', [HomeController::class, 'index'])->name('home');
