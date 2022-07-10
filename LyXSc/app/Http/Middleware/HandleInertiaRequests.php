<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;
use Illuminate\Support\Facades\Auth;
use App\Settings\GeneralSettings;
class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
  //  protected $rootView = 'app';
  public function rootView(Request $request): string
    {
        if (request()->is('admin/*')) {
            return 'app';
        }
        return 'reader.app';
    }

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            'ziggy' => function () {
                return (new Ziggy)->toArray();
            },
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
                'error' => fn () => $request->session()->get('error')
            ],
            'sitedata' => function (){
                return app(GeneralSettings::class);
            },
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'name' => $request->user()->name,
                        'email' => $request->user()->email,
                        'isAdmin'  => $request->user()->hasRole(['Super-Admin', 'Admin']),
                        'permissions' => $request->user()->getPermissionsViaRoles()->map(function ($p) {
                            return $p->name  ;
                        })->toArray(),

                    ] : null,
                ];
            },
            'guest' => Auth::guest()

        ]);
    }
}
