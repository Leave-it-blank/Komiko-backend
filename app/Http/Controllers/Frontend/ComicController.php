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
use COM;

class ComicController extends Controller
{
    public function viewComic(Comic  $comic)
    {
        Cache::forget('comic_' . $comic->titleSlug);

        $data =  cache()->remember('comic_' . $comic->titleSlug, now()->addMinutes(2), function () use ($comic) {
            $first_ch_url = null;
            if ($comic->volumes->count() != 0) {
                $first_ch_url = route('reader.chapter.view', ['comic' => $comic->titleSlug, 'volume' => $comic->volumes->first()->number, 'chapter' => $comic->volumes->first()->chapters->first()->number]);
            }

            $volume =  $comic->volumes->map(function ($volume) {
                return [
                    'chapters' => $volume->chapters->map(function ($c) {
                        return [
                            "number" => $c->number,
                            "name" => $c->name,
                            "id" => $c->id,
                            "url" => 'reader.chapter.view',
                        ];
                    })->reverse(),
                    'name' => $volume->name,
                    'number' => $volume->number,
                    'id' => $volume->id

                ];
            });

            $data_thumb = $comic->getMedia('thumbnail');
            $thumb =  $data_thumb->map(function ($media) {
                return [
                    'id' => $media->id,
                    'responsive' => $media()->attributes(['class' => 'rounded-xl h-72 w-48 select-none'])->toHtml(),
                    'alt' => $media->name,

                ];
            });

            $chapterthumb =  $data_thumb->map(function ($media) {
                return [
                    'id' => $media->id,
                    'responsive' => $media()->attributes(['class' => 'rounded-md h-20 w-28 select-none'])->toHtml(),
                    'alt' => $media->name,

                ];
            });

            $comic_tags = $comic->tags->map(function ($tag) {

                return [

                    'name' => $tag->name,
                    'svg' => $tag->number,
                    'tagCode' => $tag->tagCode

                ];
            });
            $slug = $comic->titleSlug;

            $author = $comic->author->name;

            $artist = $comic->artist->name;

            $publisher = $comic->publisher->name;
            $data = array(
                [
                    "volumes" => $volume,
                    "thumb" => $thumb,
                    "chapterthumb" => $chapterthumb,
                    "first_ch_url" => $first_ch_url,
                    "comic_tags" => $comic_tags,
                    "author" => $author,
                    "artist" => $artist,
                    "publisher" => $publisher,
                    "slug" => $slug,
                ]
            );
            return $data;
        });
        //  return dd($data);
        return Inertia::render('Frontend/Comics/ViewComic', [

            'comic' =>  [
                'id' => $comic->id,
                'title' => $comic->title,
                'viewUrl' => 'reader.comic.view',
                'titleslug' => $comic->titleSlug,
                'description' => $comic->description,
                'created_at' => $comic->created_at,
                'updated_at' => $comic->updated_at,
                'isMature' => $comic->isMature,
                'isLocked' => $comic->isLocked,
                'author' => $data["0"]["author"],
                'artist' => $data["0"]["artist"],
                'publisher' => $data["0"]["publisher"],
                'tags' => $data["0"]["comic_tags"],
                'first_ch_url' => $data["0"]["first_ch_url"],
                'thumb' =>  $data["0"]["thumb"],
                'chapterthumb' =>  $data["0"]["chapterthumb"],
                'volumes' => $data["0"]["volumes"],
                "titleSlug" => $data["0"]["slug"],
            ],

        ]);
    }
}
