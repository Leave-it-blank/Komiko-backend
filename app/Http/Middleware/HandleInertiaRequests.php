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
            'sitedata' => function () {
                //TODO :- CACHE THIS MF
                return app(GeneralSettings::class);
            },
            'ads_global' => function () {
                $ads_global =  cache()->remember('ads_global', now()->addMinutes(30), function () {
                    $ads_above_rec = \App\Helpers\Advertisement::globalAboveFooter();
                    $ads_below_rec = \App\Helpers\Advertisement::globalBelowNav();

                    return [
                        'above_rec' => $ads_above_rec,
                        'below_rec' => $ads_below_rec,
                    ];
                });
                return  $ads_global;
            },
            'auth' => function () use ($request) {
                return [
                    'user' => $request->user() ? [
                        'id' => $request->user()->id,
                        'name' => $request->user()->name,
                        'email' => $request->user()->email,
                        'isAdmin'  => $request->user()->hasRole(['Super-Admin', 'Admin']),
                        'permissions' => $request->user()->getPermissionsViaRoles()->map(function ($p) {
                            return $p->name;
                        })->toArray(),

                    ] : null,
                ];
            },
            'guest' => Auth::guest()

        ]);
    }
}
