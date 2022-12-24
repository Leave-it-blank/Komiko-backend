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


class HomapageController extends Controller
{
    /* @method Session */

    public function viewHomepage()
    {

        //Latests
        $latest = Chapter::with('volume', 'volume.comic', 'volume.comic.media')->whereHas('volume.comic', function ($c) {
            $c->where('isHidden', false);
        })->orderBy('updated_at', 'desc')->take(10)->get()->map(function ($chapter) {
            return [
                'id' => $chapter->volume->comic->id,
                'cnumber' => $chapter->number,
                'vnumber' => $chapter->volume->number,
                'cname' => $chapter->name,
                'title' => $chapter->volume->comic->title,
                'viewUrl' => route('reader.comic.view', $chapter->volume->comic->titleSlug),
                'cviewUrl' =>  route('reader.chapter.view', ['comic' => $chapter->volume->comic->titleSlug, 'volume' => $chapter->volume->number, 'chapter' => $chapter->number]),
                'titleslug' => $chapter->volume->comic->titleSlug,
                'isMature' => $chapter->volume->comic->isMature,
                'isLocked' => $chapter->volume->comic->isLocked,
                'createdAt' => $chapter->volume->comic->created_at,
                'updatedAt' => $chapter->volume->comic->updated_at,
                'type' => $chapter->volume->comic->type,
                'choice' => $chapter->volume->comic->choice,
                'thumb' => $chapter->volume->comic->getMedia('thumbnail')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'responsive' => $media()->attributes(['class' => 'rounded-xl  object-cover overflow-hidden  sm:h-72 sm:w-48 select-none   '])->toHtml(),
                        'alt' => $media->name,

                    ];
                }),

            ];
        })->toArray();
        // $tags = Tag::all()->map(function ($tag) {
        //     return [
        //         'name' => $tag->name,
        //         'id' => $tag->id,
        //         'svg' => $tag->svg,
        //         'tagCode' => $tag->tagCode
        //     ];
        // });

        $carousel =  Carousel::where('is_enabled', true)->orderBy('position', 'asc')->get()->map(function ($carousel) {
            return [

                'img' => $carousel->getMedia('carousels')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'responsive' => $media()->toHtml(),
                        'alt' => $media->name,
                    ];
                }),

                'position' => $carousel->position,
                'url' => $carousel->url
            ];
        });

        //recommended HOT UPDATES
        $recommended =  Comic::where('isHidden', false)->with('media')->withCount('chapters')->orderByViews('asc')->take(8)->get()->map(function ($comic) {
            return [
                'id' => $comic->id,
                'title' => $comic->title,
                'viewUrl' => route('reader.comic.view', $comic->titleSlug),
                'titleslug' => $comic->titleSlug,
                'isMature' => $comic->isMature,
                'isLocked' => $comic->isLocked,
                'createdAt' => $comic->created_at,
                'updatedAt' => $comic->updated_at,
                'type' => $comic->type,
                'choice' => $comic->choice,
                'thumb' => $comic->getMedia('thumbnail')->map(function ($media) {
                    return [
                        'id' => $media->id,
                        'responsive' => $media()->attributes(['class' => 'rounded-xl  object-fit overflow-hidden  sm:h-72 sm:w-48 select-none  '])->toHtml(),
                        'alt' => $media->name,

                    ];
                }),
                'chapter_count' => $comic->chapters_count,


            ];
        })->toArray();

        return Inertia::render('Frontend/HomePage', [
            // 'tags' => $tags,
            'latest' => $latest,
            'recommended' =>   $recommended,
            'carousels' =>   $carousel

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

    public function viewLatest()
    {



        $latest = Chapter::with('volume', 'volume.comic', 'volume.comic.media')->whereHas('volume.comic', function ($c) {
            $c->where('isHidden', false);
        })->orderBy('updated_at', 'desc')->paginate(15)->through(function ($chapter) {
            $chapter->cid = $chapter->volume->comic->id;
            $chapter->cnumber = $chapter->number;
            $chapter->vnumber = $chapter->volume->number;
            $chapter->comic_title = $chapter->volume->comic->title;
            $chapter->cname = $chapter->name;
            $chapter->thumb = $chapter->volume->comic->getMedia('thumbnail')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'responsive' => $media()->attributes(['class' => 'rounded-xl  object-fit overflow-hidden  sm:h-72 sm:w-48 select-none  '])->toHtml(),
                    'alt' => $media->name,

                ];
            });
            $chapter->viewUrl = route('reader.chapter.view', ['comic' => $chapter->volume->comic->titleSlug, 'volume' => $chapter->volume->number, 'chapter' => $chapter->number]);
            return $chapter;
        });


        return Inertia::render('Frontend/LatestPage', [
            'chapters' => $latest,
        ]);
    }

    public function viewComics()
    {



        $comics =  Comic::where('isHidden', false)->with('media')->withCount('chapters')->orderByViews('asc')->paginate(15)->through(function ($comic) {
            $comic->thumb = $comic->getMedia('thumbnail')->map(function ($media) {
                return [
                    'id' => $media->id,
                    'responsive' => $media()->attributes(['class' => 'rounded-xl  object-fit overflow-hidden  sm:h-72 sm:w-48 select-none  '])->toHtml(),
                    'alt' => $media->name,

                ];
            });
            $comic->viewUrl = route('reader.comic.view', $comic->titleSlug);
            return $comic;
        });


        return Inertia::render('Frontend/ComicsPage', [
            'comics' => $comics,

        ]);
    }
}
