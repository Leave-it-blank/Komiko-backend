<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Models\Comic;
use App\Models\Country;
use App\Models\Chapter;
class HomapageController extends Controller
{

    public function viewHomepage()
    {


       // dd(Chapter::orderBy('updated_at', 'asc')->with('volume.comic')->get()->groupBy('volume.comic')->limit(1));
       // dd(Comic::with('volumes.chapters')->orderBy('updated_at', 'asc')->groupBy('volumes.chapters')->having('volumes.count', '>', 0)->having('volumes.chapters.count', '>', 0)->get()->map(function ($comic) {
        //     return [
        //         'id' => $comic->id,
        //         'title' => $comic->title,
        //         'viewUrl' => 'comics_management.comics.view',
        //         'isHidden' => $comic->isHidden,
        //         'isMature' => $comic->isMature,
        //         'isLocked' => $comic->isLocked,
        //         'createdAt' => $comic->created_at,
        //         'updatedAt' => $comic->updated_at,
        //         'thumb' => $comic->getFullThumbnailUrl(),
        //         'volumes'=> $comic->volumes,
        //         'chapters'=> $comic->volumes->chapters
        //     ];
        // })->toArray());
        return Inertia::render('Frontend/HomePage', [
            'comics' => Comic::where('isHidden', false)->orderBy('updated_at', 'asc')->with('volumes.chapters')->take(4)->get()->map(function ($comic) {
                return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'viewUrl' => 'reader.comic.view',
                    'titleslug' => $comic->titleSlug,
                    'isMature' => $comic->isMature,
                    'isLocked' => $comic->isLocked,
                    'createdAt' => $comic->created_at,
                    'updatedAt' => $comic->updated_at,
                    'thumb' => $comic->getFullThumbnailUrl(),
                    'volumes'=> $comic->volumes->map(function ($volume) {
                        return [
                               'chapters' => $volume->chapters->reverse()->take(3)

                        ];}),


                ];
            })->toArray(),
            'recommended' => Comic::where('isHidden', false)->orderByViews('asc')->with('volumes.chapters')->take(4)->get()->map(function ($comic) {
                return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'viewUrl' => 'reader.comic.view',
                    'titleslug' => $comic->titleSlug,
                    'isMature' => $comic->isMature,
                    'isLocked' => $comic->isLocked,
                    'createdAt' => $comic->created_at,
                    'updatedAt' => $comic->updated_at,
                    'thumb' => $comic->getFullThumbnailUrl(),
                    'volumes'=> $comic->volumes->map(function ($volume) {
                        return [
                               'chapters' => $volume->chapters->reverse()->take(3)

                        ];}),


                ];
            })->toArray(),

            'carousels' => Carousel::where('is_enabled', true)->orderBy('position', 'asc')->get()->map(function ($carousel) {
                return [

                    'img' => $carousel->getFirstMediaUrl('carousels' ),
                    'position' => $carousel->position,
                    'url' => $carousel->url
                ];}),

        ]);
    }




    //comic view

    public function viewComic(Comic $comic)
    {
       dd($comic);
    }
}
