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

## Author

[Leave it Blank](https://github.com/Leave-it-blank/)

## License

You are hereby told not to use this project ^^ its a showcase project.
