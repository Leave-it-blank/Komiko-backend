<?php

use App\Http\Controllers\Frontend\ChapterController;
use App\Http\Controllers\Frontend\ComicController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Frontend\HomapageController;



Route::get('/', [HomapageController::class, 'viewHomepage'])->name('reader.homepage.view');

Route::get('/latest', function () {
    return redirect('https://lynxscans.com', 301);
})->name('reader.latestpage.view');

Route::get('/comics', function () {
    return redirect('https://lynxscans.com', 301);
})->name('reader.comicspage.view');

Route::get('/comics/{comic:titleSlug}', function () {
    return redirect('https://lynxscans.com', 301);
})->name('reader.comic.view');

Route::get('/comic/{comic:titleSlug}/volume/{volume:number}/chapter/{chapter:number}', function () {
    return redirect('https://lynxscans.com', 301);
})->name('reader.chapter.view');

Route::get('/bookmarks', function () {
    return redirect('https://lynxscans.com', 301);
})->name('reader.bookmarks.view');
