<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;
use App\Models\Comic;
use App\Models\Volume;
use App\Models\Chapter;
use Session;
use App\Models\Tag;

class HomapageController extends Controller
{
  /* @method Session */

    public function viewHomepage()
    {
        $comics = Comic::where('isHidden', false)->orderBy('updated_at', 'asc')  ->take(10)->get()->map(function ($comic) {
            return [
                'id' => $comic->id,
                'title' => $comic->title,
                'viewUrl' => 'reader.comic.view',
                'titleslug' => $comic->titleSlug,
                'isMature' => $comic->isMature,
                'isLocked' => $comic->isLocked,
                'createdAt' => $comic->created_at,
                'updatedAt' => $comic->updated_at,
                'type' => $comic->type,
                'choice' => $comic->choice,
                'thumb' => $comic->getMedia('thumbnail')->map(function($media) {
                    return [
                        'id' => $media->id,
                        'responsive' => $media()->attributes(['class' => 'rounded-xl h-72 w-48'])->toHtml(),
                        'alt' => $media->name,

                    ];
                }),
                'chapter_count' => Chapter::where('comic_id', $comic->id)->count(),

            ];

        })->toArray();
        $tags = Tag::all()->map(function ($tag){
            return [
                'name' => $tag->name,
                'id'=> $tag->id,
                'svg' => $tag->svg
            ];

        });

        return Inertia::render('Frontend/HomePage', [
            'tags' => $tags,
            'comics' => $comics,
            'recommended' =>  Comic::where('isHidden', false)->orderByViews('asc')->with(['volumes', 'volumes.chapters'])->take(4)->get()->map(function ($comic) {
                return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'viewUrl' => 'reader.comic.view',
                    'titleslug' => $comic->titleSlug,
                    'isMature' => $comic->isMature,
                    'isLocked' => $comic->isLocked,
                    'createdAt' => $comic->created_at,
                    'updatedAt' => $comic->updated_at,
                    'thumb' => $comic->getMedia('thumbnail')->map(function($media) {
                        return [
                            'id' => $media->id,
                            'responsive' => $media()->toHtml(),
                            'alt' => $media->name,

                        ];
                    }),
                    'volumes' => $comic->volumes->map(function ($volume) {
                        return [
                            'chapters' =>  $volume->chapters->sortBy('desc')->take(1)->map(function ($c) {
                                $uid = Session::getId();
                                return [
                                    'id' => $c->id,
                                    'number' => $c->number,
                                    'name' => $c->name,
                                    'url' =>  'reader.chapter.view',
                                    'urldata' => ['random' => $uid, 'chapter' => $c]
                                ];
                            }),

                        ];
                    }),


                ];
            })->toArray(),

            'carousels' =>   Carousel::where('is_enabled', true)->orderBy('position', 'asc')->get()->map(function ($carousel) {
                return [

                    'img' => $carousel->getMedia('carousels')->map(function($media) {
                        return [
                            'id' => $media->id,
                            'responsive' => $media()->toHtml(),
                            'alt' => $media->name,
                        ];
                    }),

                    'position' => $carousel->position,
                    'url' => $carousel->url
                ];
            }),

        ]);
       /*  return Inertia::render('Frontend/HomePage', [
            'comics' => Comic::where('isHidden', false)->orderBy('updated_at', 'asc')->with(['volumes', 'volumes.chapters'])->take(4)->get()->map(function ($comic) {
                return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'viewUrl' => 'reader.comic.view',
                    'titleslug' => $comic->titleSlug,
                    'isMature' => $comic->isMature,
                    'isLocked' => $comic->isLocked,
                    'createdAt' => $comic->created_at,
                    'updatedAt' => $comic->updated_at,

                    'thumb' => $comic->getMedia('thumbnail')->map(function($media) {
                        return [
                            'id' => $media->id,
                            'responsive' => $media()->toHtml(),
                            'alt' => $media->name,

                        ];
                    }),
                    'volumes' => $comic->volumes->sortByDesc('number')->take(1)->map(function ($volume) {
                        return [
                            'chapters' =>  $volume->chapters->sortBy('desc')->take(3)->map(function ($c) {
                                $uid = Session::getId();
                                return [
                                    'id' => $c->id,
                                    'number' => $c->number,
                                    'name' => $c->name,
                                    'url' =>  'reader.chapter.view',
                                    'urldata' => ['random' => $uid, 'chapter' => $c],


                                ];

                            }),
                            'id' => $volume->id,
                            'number' => $volume->number,
                        ];
                    }),


                ];
            })->toArray(),
            'recommended' =>  Comic::where('isHidden', false)->orderByViews('asc')->with(['volumes', 'volumes.chapters'])->take(4)->get()->map(function ($comic) {
                return [
                    'id' => $comic->id,
                    'title' => $comic->title,
                    'viewUrl' => 'reader.comic.view',
                    'titleslug' => $comic->titleSlug,
                    'isMature' => $comic->isMature,
                    'isLocked' => $comic->isLocked,
                    'createdAt' => $comic->created_at,
                    'updatedAt' => $comic->updated_at,
                    'thumb' => $comic->getMedia('thumbnail')->map(function($media) {
                        return [
                            'id' => $media->id,
                            'responsive' => $media()->toHtml(),
                            'alt' => $media->name,

                        ];
                    }),
                    'volumes' => $comic->volumes->map(function ($volume) {
                        return [
                            'chapters' =>  $volume->chapters->sortBy('desc')->take(1)->map(function ($c) {
                                $uid = Session::getId();
                                return [
                                    'id' => $c->id,
                                    'number' => $c->number,
                                    'name' => $c->name,
                                    'url' =>  'reader.chapter.view',
                                    'urldata' => ['random' => $uid, 'chapter' => $c]
                                ];
                            }),

                        ];
                    }),


                ];
            })->toArray(),

            'carousels' =>   Carousel::where('is_enabled', true)->orderBy('position', 'asc')->get()->map(function ($carousel) {
                return [

                    'img' => $carousel->getMedia('carousels')->map(function($media) {
                        return [
                            'id' => $media->id,
                            'responsive' => $media()->toHtml(),
                            'alt' => $media->name,
                        ];
                    }),

                    'position' => $carousel->position,
                    'url' => $carousel->url
                ];
            }),

        ]); */
    }




    //comic view

    public function viewComic(Comic $comic)
    {
        $comic = Comic::where('id', $comic->id)->with(['volumes', 'volumes.chapters'])->get();
        //dd($comic);
        return Inertia::render('Frontend/Comics/ViewComic', [
            'comic' => [
                'id' => $comic[0]->id,
                'title' => $comic[0]->title,
                'viewUrl' => 'reader.comic.view',
                'titleslug' => $comic[0]->titleSlug,
                'isMature' => $comic[0]->isMature,
                'isLocked' => $comic[0]->isLocked,
                'createdAt' => $comic[0]->created_at,
                'updatedAt' => $comic[0]->updated_at,
                'thumb' => $comic[0]->getMedia('thumbnail')->map(function($media) {
                    return [
                        'id' => $media->id,
                        'responsive' => $media()->toHtml(),
                        'alt' => $media->name,

                    ];
                }),
                'volumes' => $comic[0]->volumes->map(function ($volume) {
                    return [
                        'chapters' => $volume->chapters->reverse(),
                        'name' => $volume->name,
                        'number' => $volume->number,
                        'id' => $volume->id

                    ];
                }),

            ]
        ]);
    }

    public function viewChapterReader( $uid, Chapter $chapter)
    {
          if($uid == Session::getId()){

           return Inertia::render('Frontend/Comics/Reader/ViewChapter', [
            'chapter' => $chapter,
             'pages' => $chapter->pages->map(function ($page)
             {
               return [ 'page_url' => $page->getPage()];
             }),
            ]);
          }
        return 'request expired, please go back to homepage.';
    }
}
