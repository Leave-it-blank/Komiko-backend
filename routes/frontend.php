<?php


use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

use App\Http\Controllers\Frontend\HomapageController;
use App\Http\Controllers\Frontend\TagsController;

Route::get('/', [HomapageController::class, 'viewHomepage'])->name('reader.homepage.view');

Route::get('/comics/{comic:titleSlug}', [HomapageController::class, 'viewComic'])->name('reader.comic.view');
//Route::get('/comics', [ComicpageController::class, 'dash_home'])->name('comic_home');

//Route::get('/test', [ComicpageController::class, 'dash_home'])->name('comic_test');

Route::get('/c/{random}/{chapter}', [HomapageController::class, 'viewChapterReader'])->name('reader.chapter.view');



 Route::get('/tags/{tag:tagCode}', [TagsController::class, 'tagView'])->name('reader.tag.view');
