# Comic Blog WebApp

How it looks:
  <img src="https://github.com/Leave-it-blank/Kirikon/blob/3505731c53964814dfc34df835af9e7ece01c115/production/screencapture-beta-lynxscans-admin-management-settings-2023-01-18-22_53_40.png"/>

Includes Server utilities:

- [Laravel](https://laravel.com)
  - Framework for backend.
- [Inertia](https://inertiajs.com)
  - For linking with spa.
- [Redis](https://www.npmjs.com/package/redis)
  - Caching solution for backend.
- [Mysql](https://www.npmjs.com/package/morgan)
  - Database for storing data.
- [Vue3](https://vuejs.org)
  - Frontend framework for spa.
- [Horizon](https://laravel.com/docs/9.x/horizon)
  - Queue solution for jobs
- [Spartie Media Library](https://spatie.be/docs/laravel-medialibrary/v10/basic-usage/retrieving-media)
  - For image manupulation and management.
- [Spartie Settings](https://github.com/spatie/laravel-settings)
  - For Storing Website settings effectively.
- [Eloquent Viewable](https://github.com/cyrildewit/eloquent-viewable)
  - For Storing Website views. [need to implement it in website itself and drop this.]

Development utilities:

- [Debugar](https://github.com/barryvdh/laravel-debugbar)
  - Use the DebugBar only in development. It can slow the application down (because it has to gather data). 
- [eslint](https://www.npmjs.com/package/eslint)
  - ESLint is a tool for identifying and reporting on patterns found in ECMAScript/JavaScript code.
- [Docker](https://www.npmjs.com/package/docker)
  - Dockerize the whole application
  
## Work in progress

- [Docker](https://www.npmjs.com/package/docker)
  - Implement it for production and manage image based release cycle.

## Setup

```
npm install && run dev
```

 

## Development

```
php artisan migrate:fresh --seed
php artisan horizon
php artisan serve
npm run watch
```

## Project layout

The code for the website is contained in the `resource`, 'database' and 'app' directory mostly. All of the test are in the `tests` folder(wip). The code follows the **Model-View-Controller** pattern with all of the database code and business logic in the 'app/http/controller' dir, and all of the routing (`route`) Dir by default as provided in laravel 9.x.

```text
├── documentation           <- template documentation files
├── deploy                  <- Production docker template and images for website.  
├── app                     <- Website logic and models
│   ├── Http/controllers/   <- application controllers for routes <- microservice
│   ├── Models              <- Models with specific logic.
│   ├── tests/              <- code for the testing various apis  //wip
│   └── routes/             <- code for the routes and binding to controller.
├── tailwind.config.json    <- tailwind setup config
├── package.json            <- node setup config
├── .env.example            <- example setup env file
```

## Data Model

The User model contains the following fields: (laravel default) 

| Name       | Type       | Optional |
| ---------- | ---------- | -------- |
| id         | Integer    | False    |
| name       | String(64) | False    |
| email      | String(64) | False    |
| password   | String(32) | False    |
| created_at | DateTime   | auto     |
| updated_at | DateTime   | auto     |
| deleted_at | DateTime   | auto     |

Role Enum
'check database/seeder/'

#Note
following php 'PHP_EXTENSIONS="mysqli pgsql pdo_mysql pdo_pgsql gd gd2 ext-gd sqlite pdo_sqlite"' are required. to run.


## Routes

  ```

  GET|HEAD  / ........................................................................... reader.homepage.view › Frontend\HomapageController@viewHomepage
  GET|HEAD  _debugbar/assets/javascript ..................................................... debugbar.assets.js › Barryvdh\Debugbar › AssetController@js
  GET|HEAD  _debugbar/assets/stylesheets .................................................. debugbar.assets.css › Barryvdh\Debugbar › AssetController@css
  DELETE    _debugbar/cache/{key}/{tags?} ............................................ debugbar.cache.delete › Barryvdh\Debugbar › CacheController@delete
  GET|HEAD  _debugbar/clockwork/{id} ........................................... debugbar.clockwork › Barryvdh\Debugbar › OpenHandlerController@clockwork
  GET|HEAD  _debugbar/open ...................................................... debugbar.openhandler › Barryvdh\Debugbar › OpenHandlerController@handle
  POST      _ignition/execute-solution .................................... ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD  _ignition/health-check ................................................ ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST      _ignition/update-config ............................................. ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  POST      admin/auth/id/{user}/passcode ....................... authentication.users.passcode.store › Backend\Authentication\UsersController@storeCodes
  GET|HEAD  admin/auth/users ..................................................... authentication.users › Backend\Authentication\UsersController@getUsers
  GET|HEAD  admin/auth/users/id/{user} ...................................... authentication.users.edit › Backend\Authentication\UsersController@editUser
  POST      admin/auth/users/id/{user}/infoupdate ............... authentication.users.detail.store › Backend\Authentication\UsersController@storeDetails
  POST      admin/auth/users/id/{user}/userRolesUpdate ........ authentication.users.roles.store › Backend\Authentication\UsersController@userRolesUpdate
  GET|HEAD  admin/dashboard ....................................................................... dashboard › Backend\DashboardController@viewDashboard
  GET|HEAD  admin/management/advertisements/view ...... site.management.advertisements.view › Backend\Management\AdvertismentController@viewAdvertisement
  GET|HEAD  admin/management/advertisements/{advertisement}/edit site.management.advertisements.edit › Backend\Management\AdvertismentController@editAdv…
  GET|HEAD  admin/management/advertisements/{advertisement}/status site.management.advertisements.status.update › Backend\Management\AdvertismentControl…
  POST      admin/management/advertisements/{advertisement}/store site.management.advertisements.edit.store › Backend\Management\AdvertismentController@…
  GET|HEAD  admin/management/carousel .................................... admin.management.carousel › Backend\Management\CarouselController@viewCarousel
  GET|HEAD  admin/management/carousel/create .................... comic.management.carousel.create › Backend\Management\CarouselController@createCarousel
  POST      admin/management/carousel/store ....................... comic.management.carousel.store › Backend\Management\CarouselController@storeCarousel
  GET|HEAD  admin/management/carousel/{carousel}/delete ........ comics_management.carousel.delete › Backend\Management\CarouselController@deleteCarousel
  GET|HEAD  admin/management/carousel/{carousel}/edit ............... comic.management.carousel.edit › Backend\Management\CarouselController@editCarousel
  POST      admin/management/carousel/{carousel}/update comic.management.carousel.store.update › Backend\Management\CarouselController@updateStoreCarous…
  GET|HEAD  admin/management/chapter/{chapter}/delete ...... comics_management.chapter.delete › Backend\ComicsManagement\ChaptersController@deleteChapter
  GET|HEAD  admin/management/chapter/{chapter}/purge ......... comics_management.chapter.purge › Backend\ComicsManagement\ChaptersController@purgeChapter
  POST      admin/management/chapter/{chapter}/upload/data comics_management.chapter.upload.store › Backend\ComicsManagement\ChaptersController@uploadCh…
  GET|HEAD  admin/management/chapter/{chapter}/view ............ comics_management.chapter.view › Backend\ComicsManagement\ChaptersController@viewChapter
  POST      admin/management/comic/{comic}/createvolume comics_management.volume.create.store › Backend\ComicsManagement\ChaptersController@createVolume…
  GET|HEAD  admin/management/comics ...................................... comics_management.comics › Backend\ComicsManagement\ComicsController@getComics
  GET|HEAD  admin/management/comics/create ..................... comics_management.comics.create › Backend\ComicsManagement\ComicsController@createComics
  POST      admin/management/comics/create ........................ comics_management.comics.store › Backend\ComicsManagement\ComicsController@storeComic
  GET|HEAD  admin/management/comics/{comic}/edit ................... comics_management.comics.edit › Backend\ComicsManagement\ComicsController@editComics
  POST      admin/management/comics/{comic}/edit ......... comics_management.comics.edit.store › Backend\ComicsManagement\ComicsController@editStoreComic
  GET|HEAD  admin/management/comics/{comic}/view ................... comics_management.comics.view › Backend\ComicsManagement\ComicsController@viewComics
  GET|HEAD  admin/management/page/{page}/delete .................. comics_management.page.delete › Backend\ComicsManagement\ChaptersController@deletePage
  GET|HEAD  admin/management/page/{page}/view ........................ comics_management.page.view › Backend\ComicsManagement\ChaptersController@viewPage
  GET|HEAD  admin/management/settings ........................................... site.management.settings › Backend\Site\SettingsController@viewSettings
  POST      admin/management/settings/update ............................ site.management.settings.store › Backend\Site\SettingsController@updateSettings
  GET|HEAD  admin/management/tag/{tag}/delete ................................ comics_management.tag.delete › Backend\Management\TagsController@deleteTag
  GET|HEAD  admin/management/tags .................................................... admin.management.tags › Backend\Management\TagsController@viewTags
  POST      admin/management/tags/store ....................................... comic.management.tags.store › Backend\Management\TagsController@storeTags
  GET|HEAD  admin/management/volume/{volume}/delete .......... comics_management.volume.delete › Backend\ComicsManagement\ChaptersController@deleteVolume
  GET|HEAD  admin/management/volume/{volume}/view ................ comics_management.volume.view › Backend\ComicsManagement\ChaptersController@viewVolume
  POST      admin/management/{volume}/chapter/create ......... comics_management.chapter.store › Backend\ComicsManagement\ChaptersController@storeChapter
  GET|HEAD  api/comics .............................................................................. api.comicspage.view › Api\HomeController@viewComics
  GET|HEAD  api/comics/{comic} ........................................................................... api.comic.view › Api\ComicController@viewComic
  GET|HEAD  api/comics/{comic}/volume/{volume}/chapter/{chapter} ..................................... api.chapter.view › Api\ComicController@viewChapter
  GET|HEAD  api/getallcomics .................................................................... api.allcomic.view › Api\HomeController@getAllComicsSlug
  GET|HEAD  api/homepage ................................................................................ api.homepage.view › Api\HomeController@viewHome
  GET|HEAD  api/latest .............................................................................. api.latestpage.view › Api\HomeController@viewLatest
  GET|HEAD  api/user .................................................................................................................................... 
  GET|HEAD  bookmarks ............................................................................................................. reader.bookmarks.view
  GET|HEAD  comic/{comic}/volume/{volume}/chapter/{chapter} ......................................................................... reader.chapter.view
  GET|HEAD  comics ............................................................................................................... reader.comicspage.view
  GET|HEAD  comics/{comic} ............................................................................................................ reader.comic.view
  DELETE    dash/user .......................................................... current-user.destroy › Laravel\Jetstream › CurrentUserController@destroy
  DELETE    dash/user/other-browser-sessions ................ other-browser-sessions.destroy › Laravel\Jetstream › OtherBrowserSessionsController@destroy
  GET|HEAD  dash/user/profile ............................................................. profile.show › Laravel\Jetstream › UserProfileController@show
  DELETE    dash/user/profile-photo ..................................... current-user-photo.destroy › Laravel\Jetstream › ProfilePhotoController@destroy
  GET|HEAD  forgot-password ..................................................... password.request › Laravel\Fortify › PasswordResetLinkController@create
  POST      forgot-password ........................................................ password.email › Laravel\Fortify › PasswordResetLinkController@store
  GET|HEAD  horizon/api/batches .................................................. horizon.jobs-batches.index › Laravel\Horizon › BatchesController@index
  POST      horizon/api/batches/retry/{id} ....................................... horizon.jobs-batches.retry › Laravel\Horizon › BatchesController@retry
  GET|HEAD  horizon/api/batches/{id} ............................................... horizon.jobs-batches.show › Laravel\Horizon › BatchesController@show
  GET|HEAD  horizon/api/jobs/completed ................................... horizon.completed-jobs.index › Laravel\Horizon › CompletedJobsController@index
  GET|HEAD  horizon/api/jobs/failed ............................................ horizon.failed-jobs.index › Laravel\Horizon › FailedJobsController@index
  GET|HEAD  horizon/api/jobs/failed/{id} ......................................... horizon.failed-jobs.show › Laravel\Horizon › FailedJobsController@show
  GET|HEAD  horizon/api/jobs/pending ......................................... horizon.pending-jobs.index › Laravel\Horizon › PendingJobsController@index
  POST      horizon/api/jobs/retry/{id} ............................................... horizon.retry-jobs.show › Laravel\Horizon › RetryController@store
  GET|HEAD  horizon/api/jobs/silenced ...................................... horizon.silenced-jobs.index › Laravel\Horizon › SilencedJobsController@index
  GET|HEAD  horizon/api/jobs/{id} ............................................................. horizon.jobs.show › Laravel\Horizon › JobsController@show
  GET|HEAD  horizon/api/masters .............................................. horizon.masters.index › Laravel\Horizon › MasterSupervisorController@index
  GET|HEAD  horizon/api/metrics/jobs .......................................... horizon.jobs-metrics.index › Laravel\Horizon › JobMetricsController@index
  GET|HEAD  horizon/api/metrics/jobs/{id} ....................................... horizon.jobs-metrics.show › Laravel\Horizon › JobMetricsController@show
  GET|HEAD  horizon/api/metrics/queues .................................... horizon.queues-metrics.index › Laravel\Horizon › QueueMetricsController@index
  GET|HEAD  horizon/api/metrics/queues/{id} ................................. horizon.queues-metrics.show › Laravel\Horizon › QueueMetricsController@show
  GET|HEAD  horizon/api/monitoring .............................................. horizon.monitoring.index › Laravel\Horizon › MonitoringController@index
  POST      horizon/api/monitoring .............................................. horizon.monitoring.store › Laravel\Horizon › MonitoringController@store
  GET|HEAD  horizon/api/monitoring/{tag} .............................. horizon.monitoring-tag.paginate › Laravel\Horizon › MonitoringController@paginate
  DELETE    horizon/api/monitoring/{tag} ................................ horizon.monitoring-tag.destroy › Laravel\Horizon › MonitoringController@destroy
  GET|HEAD  horizon/api/stats .................................................... horizon.stats.index › Laravel\Horizon › DashboardStatsController@index
  GET|HEAD  horizon/api/workload .................................................... horizon.workload.index › Laravel\Horizon › WorkloadController@index
  GET|HEAD  horizon/{view?} ...................................................................... horizon.index › Laravel\Horizon › HomeController@index
  GET|HEAD  latest ............................................................................................................... reader.latestpage.view
  GET|HEAD  login ....................................................................... login › Laravel\Fortify › AuthenticatedSessionController@create
  POST      login ................................................................................ Laravel\Fortify › AuthenticatedSessionController@store
  POST      logout .................................................................... logout › Laravel\Fortify › AuthenticatedSessionController@destroy
  GET|HEAD  register ....................................................................... register › Laravel\Fortify › RegisteredUserController@create
  POST      register ................................................................................... Laravel\Fortify › RegisteredUserController@store
  POST      reset-password .............................................................. password.update › Laravel\Fortify › NewPasswordController@store
  GET|HEAD  reset-password/{token} ...................................................... password.reset › Laravel\Fortify › NewPasswordController@create
  GET|HEAD  sanctum/csrf-cookie ............................................................................. Laravel\Sanctum › CsrfCookieController@show
  GET|HEAD  two-factor-challenge .................................... two-factor.login › Laravel\Fortify › TwoFactorAuthenticatedSessionController@create
  POST      two-factor-challenge ........................................................ Laravel\Fortify › TwoFactorAuthenticatedSessionController@store
  GET|HEAD  user/confirm-password .................................................................. Laravel\Fortify › ConfirmablePasswordController@show
  POST      user/confirm-password .............................................. password.confirm › Laravel\Fortify › ConfirmablePasswordController@store
  GET|HEAD  user/confirmed-password-status ............................. password.confirmation › Laravel\Fortify › ConfirmedPasswordStatusController@show
  POST      user/confirmed-two-factor-authentication ............ two-factor.confirm › Laravel\Fortify › ConfirmedTwoFactorAuthenticationController@store
  PUT       user/password ............................................................ user-password.update › Laravel\Fortify › PasswordController@update
  PUT       user/profile-information ............................ user-profile-information.update › Laravel\Fortify › ProfileInformationController@update
  POST      user/two-factor-authentication ................................ two-factor.enable › Laravel\Fortify › TwoFactorAuthenticationController@store
  DELETE    user/two-factor-authentication ............................. two-factor.disable › Laravel\Fortify › TwoFactorAuthenticationController@destroy
  GET|HEAD  user/two-factor-qr-code ............................................... two-factor.qr-code › Laravel\Fortify › TwoFactorQrCodeController@show
  GET|HEAD  user/two-factor-recovery-codes ................................... two-factor.recovery-codes › Laravel\Fortify › RecoveryCodeController@index
  POST      user/two-factor-recovery-codes ............................................................... Laravel\Fortify › RecoveryCodeController@store
  GET|HEAD  user/two-factor-secret-key ...................................... two-factor.secret-key › Laravel\Fortify › TwoFactorSecretKeyController@show

```

                                 
## Author

[Leave it Blank](https://github.com/Leave-it-blank/)

## License

You are hereby told not to use this project ^^ its a showcase project.
