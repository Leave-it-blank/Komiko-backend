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

class ComicController extends Controller
{
    public function viewComic(Comic $comic)
    {
        $comic = Comic::where('id', $comic->id)->with(['volumes', 'volumes.chapters', 'artist', 'author', 'publisher', 'tags'])->get();
        //dd($comic);
        return Inertia::render('Frontend/Comics/ViewComic', [
            'comic' => [
                'id' => $comic[0]->id,
                'title' => $comic[0]->title,
                'viewUrl' => 'reader.comic.view',
                'titleslug' => $comic[0]->titleSlug,
                'description' => $comic[0]->description,
                'created_at' => $comic[0]->created_at,
                'updated_at' => $comic[0]->updated_at,
                'isMature' => $comic[0]->isMature,
                'isLocked' => $comic[0]->isLocked,
                'author' => $comic[0]->author->name,
                'artist' => $comic[0]->artist->name,
                'publisher' => $comic[0]->publisher->name,
                'tags' => $comic[0]->tags->map(function ($tag) {
                    return [

                        'name' => $tag->name,
                        'svg' => $tag->number,
                        'tagCode' => $tag->tagCode

                    ];
                }),
                'updatedAt' => $comic[0]->updated_at,
                'type' => $comic[0]->type,
                'thumb' => $comic[0]->getMedia('thumbnail')->map(function($media) {
                    return [
                        'id' => $media->id,
                        'responsive' => $media()->attributes(['class' => 'rounded-xl h-72 w-48 select-none'])->toHtml(),
                        'alt' => $media->name,

                    ];
                }),
                'chapterthumb' => $comic[0]->getMedia('thumbnail')->map(function($media) {
                    return [
                        'id' => $media->id,
                        'responsive' => $media()->attributes(['class' => 'rounded-md h-20 w-28 select-none'])->toHtml(),
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

}
