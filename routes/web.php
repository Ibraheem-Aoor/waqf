<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::group(['as' => 'site.'], function () {

    // Site Routes
    Route::get('/about-us', [HomeController::class, 'about'])->name('about');
    Route::get('/about-user', [HomeController::class, 'aboutUser'])->name('about_user');
    Route::get('/azkar', [HomeController::class, 'azkar'])->name('azkar.index');
    Route::get('/azkar/{id}', [HomeController::class, 'azkarShow'])->name('azkar.show');
    // E-Sebha
    Route::get('masbaha', [HomeController::class, 'masbaha'])->name('masbaha');

    // Quran Routes: Suwar , Reciters and Listening to Rectiters
    Route::prefix('quran')->as('quran.')->group(function () {
        Route::get('/', [QuranController::class, 'index'])->name('index');
        Route::get('/sura/{id}', [QuranController::class, 'showSura'])->name('sura');
        Route::get('/reciter', [QuranController::class, 'reciterIndex'])->name('reciter.index');
        Route::get('/reciter/{id}/rewaya/{rewaya}', [QuranController::class, 'reciterSuwar'])->name('reciter.suwar');
        Route::get('/reciter/{reciter}/suwar/{sura}/rewaya/{rewaya}', [QuranController::class, 'reciterListen'])->name('reciter.listen');
    });
    
    Route::get('/{user?}', [HomeController::class, 'index'])->name('home');
});
