<?php

use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\PublicAssetController;
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

// Resume viewer — opens the PDF with Download + Print buttons.
Route::get('/resume', [PortfolioController::class, 'resume'])->name('resume');

// Serve public assets through the app. Vercel routes everything to the PHP
// function, so static files (CSS, JS, fonts, images, PDF) need explicit routes.
Route::get('/build/{path}', [PublicAssetController::class, 'build'])->where('path', '.*');
Route::get('/images/{path}', [PublicAssetController::class, 'images'])->where('path', '.*');
Route::get('/files/{path}', [PublicAssetController::class, 'files'])->where('path', '.*');
Route::get('/favicon.ico', [PublicAssetController::class, 'favicon']);
Route::get('/robots.txt', [PublicAssetController::class, 'robots']);
