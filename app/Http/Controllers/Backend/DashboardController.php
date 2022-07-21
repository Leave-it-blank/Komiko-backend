<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use App\Models\Comic;
class DashboardController extends Controller
{
    /* @method views() */
    public function viewDashboard()
    {
       $userdata = User::count();
       $comicviewcount = views(Comic::class)->remember(now()->addWeeks(1))->count();
       $chapterviewcount = views(Chapter::class)->remember(now()->addWeeks(1))->count();
       $comics = Comic::orderByViews('asc')->limit(8)->get();

        return Inertia::render('HomeView' ,[
            'stats' => [
                'usercount' => $userdata,
                'comicviewcount' => $comicviewcount,
                'chapterviewcount' => $chapterviewcount,
                'comics' => $comics
            ]
        ]);
    }
}
