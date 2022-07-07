<?php

/* use App\Http\Controllers\Backend\Authentication\PermissionController;
use App\Http\Controllers\Backend\Authentication\RolesController;
use App\Http\Controllers\Backend\Authentication\UsersController;
use App\Http\Controllers\Backend\ComicManagement\ArtistController;
use App\Http\Controllers\Backend\ComicManagement\AuthorController;
use App\Http\Controllers\Backend\ComicManagement\ChaptersController;
use App\Http\Controllers\Backend\ComicManagement\ComicsController;
use App\Http\Controllers\Backend\ComicManagement\CountriesController;
use App\Http\Controllers\Backend\ComicManagement\PublisherController;
use App\Http\Controllers\Backend\ComicManagement\TagsController;
use App\Http\Controllers\Backend\ComicManagement\VolumesController;
use App\Http\Controllers\Backend\Management\AdvertisementController;
use App\Http\Controllers\Backend\Management\CarouselController;
use App\Http\Controllers\Backend\Management\SettingsController; */
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use App\Actions\Fortify\UpdateUserPassword;
/*

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::group(['middleware' => ['permission:handle comic management|view comic management']],
    function () {

        Route::get('admin/comics',  \App\Http\Livewire\Backend\Management\Comics\Index::class)->name('admin.comics');
        Route::get('admin/comic/create', \App\Http\Livewire\Backend\Management\Comics\Actions\Create::class)->name('admin.comic.create');
        Route::get('admin/comic/{comic}', \App\Http\Livewire\Backend\Management\Comics\Comic\Actions\View::class)->name('admin.comic.view');
        Route::get('admin/comic/{comic}/edit', [ ComicsController::class, 'comic_edit'])->name('admin.comic.edit');
        Route::get('admin/volume/{volume}/edit', [ VolumesController::class, 'volume_edit'])->name('admin.volume.edit');
        Route::get('admin/volume/{volume}',\App\Http\Livewire\Backend\Management\Comics\Comic\Volumes\Actions\View::class)->name('admin.volume.view');
        Route::get('admin/chapter/{chapter}',\App\Http\Livewire\Backend\Management\Comics\Comic\Chapters\Actions\View::class)->name('admin.chapter.view');
        Route::get('admin/chapter/{chapter}/edit', [ ChaptersController::class, 'chapter_edit'])->name('admin.chapter.edit');
        Route::get('admin/page/{page}', [ ChaptersController::class, 'page_view'])->name('admin.page.view');

    });

Route::group(['middleware' => ['permission:handle management|view management']],
    function () {
        Route::get('admin/comic-management/carousel', \App\Http\Livewire\Backend\ComicManagement\Carousels\Index::class)->name('comic.management.carousel');
        Route::get('admin/comic-management/carousel/create',\App\Http\Livewire\Backend\ComicManagement\Carousels\Actions\Create::class)->name('comic.management.carousel.create');
        Route::get('admin/comic-management/carousel/{carousel}/edit', \App\Http\Livewire\Backend\ComicManagement\Carousels\Actions\Edit::class)->name('comic.management.carousel.edit');

        Route::get('admin/comic-management/countries', \App\Http\Livewire\Backend\ComicManagement\Countries\Index::class)->name('comic.management.country');
        Route::get('admin/comic-management/tags',  \App\Http\Livewire\Backend\ComicManagement\Tags\Index::class)->name('comic.management.tag');
        Route::get('admin/comic-management/artists', \App\Http\Livewire\Backend\ComicManagement\Artists\Index::class)->name('comic.management.artist');
        Route::get('admin/comic-management/authors', \App\Http\Livewire\Backend\ComicManagement\Authors\Index::class)->name('comic.management.author');
        Route::get('admin/comic-management/publishing-house', \App\Http\Livewire\Backend\ComicManagement\Publishers\Index::class)->name('comic.management.publisher');
    });

Route::group(['middleware' => ['permission:handle authentication|view authentication']],
    function () {

        Route::get('admin/auth/users',  \App\Http\Livewire\Backend\Authentication\Users\Index::class )->name('authentication.users');
        Route::get('admin/auth/user/{user}', [UsersController::class, 'user_edit'])->name('authentication.user.edit');
        Route::put('admin/auth/user/{user}', [UsersController::class, 'user_update'])->name('authentication.user.update');
        Route::get('admin/auth/roles', \App\Http\Livewire\Backend\Authentication\Roles\Index::class)->name('authentication.roles');
        Route::get('admin/auth/permissions', \App\Http\Livewire\Backend\Authentication\Permissions\Index::class)->name('authentication.permissions');
    });
Route::group(['middleware' => ['permission:handle settings management|view settings']], function ()
{
    Route::get('admin/management/advertisements',  \App\Http\Livewire\Backend\SiteManagement\Advertisements\Index::class  )->name('site.management.advertisements');
    Route::get('admin/management/settings', \App\Http\Livewire\Backend\SiteManagement\Settings\Index::class)->name('site.management.settings');
    Route::get('admin/management/advertisement/{advertisement}', \App\Http\Livewire\Backend\SiteManagement\Advertisements\Actions\Edit::class)->name('site.management.advertisement.edit');
    Route::get('admin/management/features', \App\Http\Livewire\Backend\SiteManagement\Features\Index::class)->name('site.management.features');

});

 */


    Route::group(['middleware' => ['permission:handle comic management|view comic management']],
    function () {
        Route::get('admin/management/comics', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'getComics' ] )->name('comics_management.comics');
        Route::get('admin/management/comics/create', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'createComics' ] )->name('comics_management.comics.create');
        Route::post('admin/management/comics/create', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'storeComic' ] )->name('comics_management.comics.store');
        Route::get('admin/management/comics/{comic}/edit', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'editComics' ] )->name('comics_management.comics.edit');
        Route::post('admin/management/comics/{comic}/edit', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'editStoreComic' ] )->name('comics_management.comics.edit.store');
        Route::get('admin/management/comics/{comic}/view', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'viewComics' ] )->name('comics_management.comics.view');
        Route::post('admin/management/comic/{comic}/createvolume', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'createVolumeStore' ] )->name('comics_management.volume.create.store');
        Route::get('admin/management/volume/{volume}', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'viewVolume' ] )->name('comics_management.volume.view');
        Route::post('admin/management/{volume}/chapter/create', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'storeChapter' ] )->name('comics_management.chapter.store');
        Route::get('admin/management/{volume}/delete', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'deleteVolume' ] )->name('comics_management.volume.delete');
        Route::get('admin/management/{chapter}/delete', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'deleteChapter' ] )->name('comics_management.chapter.delete');
    });

    Route::group(['middleware' => ['permission:handle authentication|view authentication']],
    function () {

        Route::get('admin/auth/users', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'getUsers' ] )->name('authentication.users');
        Route::get('admin/auth/users/id/{user}', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'editUser' ] )->name('authentication.users.edit');
        Route::post('admin/auth/id/{user}/passcode', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'storeCodes' ] )->name('authentication.users.passcode.store'); //password update route
        Route::post('admin/auth/users/id/{user}/infoupdate', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'storeDetails' ] )->name('authentication.users.detail.store');
        Route::post('admin/auth/users/id/{user}/userRolesUpdate', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'userRolesUpdate' ] )->name('authentication.users.roles.store');

    });
