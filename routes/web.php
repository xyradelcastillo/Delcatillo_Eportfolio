<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| The whole portfolio lives on a single page. All content is provided as
| plain PHP arrays from PortfolioController — no database involved.
|
*/

Route::get('/', [PortfolioController::class, 'index'])->name('home');

// Printable / downloadable CV (generated from the same content arrays).
Route::get('/cv', [PortfolioController::class, 'cv'])->name('cv');
Route::get('/cv/download', [PortfolioController::class, 'downloadCv'])->name('cv.download');
