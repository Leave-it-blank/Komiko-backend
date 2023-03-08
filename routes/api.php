<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\ComicController;
 

 
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Reader API Routes
  Route::get('/homepage', [HomeController::class, 'viewHome'])->name('api.homepage.view');
  Route::get('/latest', [HomeController::class, 'viewLatest'])->name('api.latestpage.view');
  Route::get('/comics', [HomeController::class, 'viewComics'])->name('api.comicspage.view');
  Route::get('/comics/{comic:titleSlug}', [ComicController::class, 'viewComic'])->name('api.comic.view');
  Route::get('/comics/{comic:titleSlug}/volume/{volume:number}/chapter/{chapter:number}', [ComicController::class, 'viewChapter'])->name('api.chapter.view');
 
