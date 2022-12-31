<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\Management\AdvertismentController;
use App\Http\Controllers\Backend\Management\CarouselController;
use App\Http\Controllers\Backend\Management\TagsController;

Route::group(
    ['middleware' => ['permission:handle comic management|view comic management']],
    function () {
        Route::get('admin/management/comics', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'getComics'])->name('comics_management.comics');
        Route::get('admin/management/comics/create', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'createComics'])->name('comics_management.comics.create');
        Route::post('admin/management/comics/create', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'storeComic'])->name('comics_management.comics.store');
        Route::get('admin/management/comics/{comic}/edit', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'editComics'])->name('comics_management.comics.edit');
        Route::post('admin/management/comics/{comic}/edit', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'editStoreComic'])->name('comics_management.comics.edit.store');
        Route::get('admin/management/comics/{comic}/view', [\App\Http\Controllers\Backend\ComicsManagement\ComicsController::class, 'viewComics'])->name('comics_management.comics.view');
        Route::post('admin/management/comic/{comic}/createvolume', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'createVolumeStore'])->name('comics_management.volume.create.store');
        Route::get('admin/management/volume/{volume}/view', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'viewVolume'])->name('comics_management.volume.view');
        Route::post('admin/management/{volume}/chapter/create', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'storeChapter'])->name('comics_management.chapter.store');
        Route::get('admin/management/volume/{volume}/delete', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'deleteVolume'])->name('comics_management.volume.delete');
        Route::get('admin/management/chapter/{chapter}/delete', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'deleteChapter'])->name('comics_management.chapter.delete');
        Route::get('admin/management/page/{page}/delete', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'deletePage'])->name('comics_management.page.delete');
        Route::post('admin/management/chapter/{chapter}/upload/data', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'uploadChapter'])->name('comics_management.chapter.upload.store');
        Route::get('admin/management/chapter/{chapter}/view', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'viewChapter'])->name('comics_management.chapter.view');
        Route::get('admin/management/chapter/{chapter}/purge', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'purgeChapter'])->name('comics_management.chapter.purge');

        Route::get('admin/management/page/{page}/view', [\App\Http\Controllers\Backend\ComicsManagement\ChaptersController::class, 'viewPage'])->name('comics_management.page.view');
    }
);

Route::group(
    ['middleware' => ['permission:handle authentication|view authentication']],
    function () {

        Route::get('admin/auth/users', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'getUsers'])->name('authentication.users');
        Route::get('admin/auth/users/id/{user}', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'editUser'])->name('authentication.users.edit');
        Route::post('admin/auth/id/{user}/passcode', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'storeCodes'])->name('authentication.users.passcode.store'); //password update route
        Route::post('admin/auth/users/id/{user}/infoupdate', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'storeDetails'])->name('authentication.users.detail.store');
        Route::post('admin/auth/users/id/{user}/userRolesUpdate', [\App\Http\Controllers\Backend\Authentication\UsersController::class, 'userRolesUpdate'])->name('authentication.users.roles.store');
    }
);
Route::group(['middleware' => ['permission:handle settings management|view settings']], function () {
    Route::get('admin/management/settings',  [\App\Http\Controllers\Backend\Site\SettingsController::class, 'viewSettings'])->name('site.management.settings');
    Route::post('admin/management/settings/update',  [\App\Http\Controllers\Backend\Site\SettingsController::class, 'updateSettings'])->name('site.management.settings.store');
});

Route::group(
    ['middleware' => ['permission:handle management|view management']],
    function () {
        Route::get('admin/management/carousel',  [CarouselController::class, 'viewCarousel'])->name('admin.management.carousel');
        Route::get('admin/management/carousel/create', [CarouselController::class, 'createCarousel'])->name('comic.management.carousel.create');
        Route::post('admin/management/carousel/store', [CarouselController::class, 'storeCarousel'])->name('comic.management.carousel.store');
        Route::get('admin/management/carousel/{carousel}/edit', [CarouselController::class, 'editCarousel'])->name('comic.management.carousel.edit');
        Route::get('admin/management/carousel/{carousel}/delete', [CarouselController::class,  'deleteCarousel'])->name('comics_management.carousel.delete');  //intentional to avoid extra work making new component.
        Route::post('admin/management/carousel/{carousel}/update', [CarouselController::class, 'updateStoreCarousel'])->name('comic.management.carousel.store.update');

        Route::get('admin/management/tags',  [TagsController::class, 'viewTags'])->name('admin.management.tags');
        Route::post('admin/management/tags/store', [TagsController::class, 'storeTags'])->name('comic.management.tags.store');
        Route::get('admin/management/tag/{tag}/delete', [TagsController::class,  'deleteTag'])->name('comics_management.tag.delete');  //intentional to avoid extra work making new component.

        Route::get('admin/management/advertisements/view',  [AdvertismentController::class, 'viewAdvertisement'])->name('site.management.advertisements.view');
        Route::get('admin/management/advertisements/{advertisement}/edit',  [AdvertismentController::class, 'editAdvertisement'])->name('site.management.advertisements.edit');
        Route::get('admin/management/advertisements/{advertisement}/status',  [AdvertismentController::class, 'statusUpdateAdvertisement'])->name('site.management.advertisements.status.update');
        Route::post('admin/management/advertisements/{advertisement}/store',  [AdvertismentController::class, 'editStoreAdvertisement'])->name('site.management.advertisements.edit.store');
    }
);
Route::middleware(['auth:sanctum',   config('jetstream.auth_session'), 'verified', 'permission:view dashboard'])->group(function () {
    Route::get('/admin/dashboard',  [DashboardController::class, 'viewDashboard'])->name('dashboard');
});
