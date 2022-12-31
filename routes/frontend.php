<?php

use App\Http\Controllers\Frontend\ChapterController;
use App\Http\Controllers\Frontend\ComicController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Frontend\HomapageController;


Route::get('/', [HomapageController::class, 'viewHomepage'])->name('reader.homepage.view');
Route::get('/latest', [HomapageController::class, 'viewLatest'])->name('reader.latestpage.view');
Route::get('/comics', [HomapageController::class, 'viewComics'])->name('reader.comicspage.view');
Route::get('/comics/{comic:titleSlug}', [ComicController::class, 'viewComic'])->name('reader.comic.view');
Route::get('/comic/{comic:titleSlug}/volume/{volume:number}/chapter/{chapter:number}', [ChapterController::class, 'viewChapterReader'])->name('reader.chapter.view');
Route::get('/bookmarks', [ComicController::class, 'viewBookmarks'])->name('reader.bookmarks.view');
